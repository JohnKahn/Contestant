<?php

use Phalcon\Mvc\Controller;
use Phalcon\Filter;

class AdminController extends Controller {

	private $timeout = 21600;
	private $noLoginRedirect = false;

	public function loginAction() {
		$this->noLoginRedirect = true;
		$this->checkLogin();

		$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
		if (!$this->flashSession->has("error") && $this->session->has("admin_user")) {
			return $this->response->redirect("/admin");
		}
	}

	public function logoutAction() {
		$this->checkLogin();

		$this->session->remove("admin_user");
		$this->session->remove("admin_key");
		$this->session->remove("admin_timeout");

		return $this->response->redirect("/admin/login");
	}

	public function indexAction() {
		$this->checkLogin();
		if ($this->session->has("admin_redirect")) {
			$this->session->remove("admin_redirect");
			$this->response->redirect("/admin");
			return;
		}
	}

	public function judgeAction() {
		$this->checkLogin();
	}

	public function teamsAction() {
		$this->checkLogin();

		if ($this->request->isPost() && $this->request->hasPost("type") && $this->security->checkToken()) {
			$this->session->set("changeOccurred", true);
			$this->session->set("changeSuccessful", true);
			$this->session->set("teamsGenerated", false);
			switch ($this->request->getPost("type")) {
				case 'update':
					$team = Teams::findFirst(intval($this->request->getPost("id")));

					if ($team) {
						$team->setUsername($this->request->getPost("user"));
						if ($this->request->getPost("pass") != "") {
							$team->setPassword($this->request->getPost("pass"));
						}
						$team->save();
					} else {
						$this->session->set("changeSuccessful", false);
					}
					break;
				
				case 'create':
					$team = new Teams();
					$team->setUsername($this->request->getPost("user"));
					$team->setPassword($this->request->getPost("pass"));
					if (!$team->save()) {
						$this->session->set("changeSuccessful", false);
					}
					break;

				case 'generate':
					$this->session->set("teamsGenerated", true);
					$num = intval($this->request->getPost("num"));
					$name = $this->request->getPost("user");
					$teams = array();
					$info = "";
					for ($i = 0; $i < $num; $i++) { 
						$teams[$i] = new Teams();
						$teams[$i]->setUsername(str_replace("#", $i+1, $name));
						$pass = Phalcon\Text::random(Phalcon\Text::RANDOM_ALNUM, 8);
						$teams[$i]->setPassword($pass);
						$info .= $teams[$i]->getUsername() . ":" . $pass . ",";
						if ($teams[$i]->save() == false) {
							$this->session->set("changeSuccessful", false);
							$this->session->set("teamsGenerated", false);
							for ($j = 0; $j <= $i; $j++) {
								$teams[$j]->delete();
							}
							break;
						}
					}
					$info = substr($info, 0, strlen($info)-1);
					$this->session->set("generatedInfo", $info);
					break;

				case 'delete':
					$team = Teams::findFirst(intval($this->request->getPost("id")));
					if ($team->delete() == false) {
						$this->session->set("changeSuccessful", false);
					}
					break;

				default:
					$this->session->set("changeSuccessful", false);
					break;
			}
			return $this->response->redirect("/admin/teams");
		} else {
			if ($this->session->has("changeOccurred")) {
				$this->view->changeOccurred = $this->session->get("changeOccurred");
				$this->session->remove("changeOccurred");
			}

			if ($this->session->has("changeSuccessful")) {
				$this->view->changeSuccessful = $this->session->get("changeSuccessful");
				$this->session->remove("changeSuccessful");
			}

			if ($this->session->has("teamsGenerated")) {
				$this->view->teamsGenerated = $this->session->get("teamsGenerated");
				$this->session->remove("teamsGenerated");
			}
			
			if ($this->session->has("generatedInfo")) {
				$genInfo = $this->session->get("generatedInfo");
				$tempArr = explode(",", $genInfo);
				$genTeams = array();
				for ($i = 0; $i < count($tempArr); $i++) {
					$tempTeam = explode(":", $tempArr[$i]);
					$genTeams[$i] = array("username" => $tempTeam[0], "password" => $tempTeam[1]);
				}
				$this->view->genTeams = $genTeams;
				//die(print_r($genInfo));
				$this->session->remove("generatedInfo");
			}
		}

		$this->view->teams = Teams::find();
	}

	public function problemsAction() {
		if (!$this->checkLogin()) return;

		if ($this->request->isPost() && $this->request->hasPost("type") && $this->security->checkToken()) {
			$this->session->set("changeOccurred", true);
			$this->session->set("changeSuccessful", true);
			$this->session->set("teamsGenerated", false);
			switch ($this->request->getPost("type")) {
				case 'update':
					$problem = Problems::findFirst(intval($this->request->getPost("id")));

					if ($problem) {
						$problem->setName($this->request->getPost("name"));
						$problem->setRuntime($this->request->getPost("runtime"));

						if ($this->request->hasPost("hasDataFile")) {
							if ($this->request->hasFiles()) { // Adding data file
								foreach ($this->request->getUploadedFiles() as $file){
									if ($file->getKey() == "dataFile") {
										unlink($problem->getDataFile());
										$dataFileLocation = "../app/data/" . Phalcon\Text::random(Phalcon\Text::RANDOM_ALNUM, rand(13, 17)) . ".dat";
										$problem->setDataFile($dataFileLocation);
										$problem->setDataFileFriendly($file->getName());
										$file->moveTo($dataFileLocation);
									}
								}
							}
						} else {
							if ($problem->getDataFile() != null) { // Removing data file
								unlink($problem->getDataFile());
								$problem->setDataFile(null);
								$problem->setDataFileFriendly(null);
							}
						}

						if ($this->request->hasPost("hasJudgeFile")) {
							if ($this->request->hasFiles()) { // Adding judge file
								foreach ($this->request->getUploadedFiles() as $file){
									if ($file->getKey() == "judgeFile") {
										unlink($problem->getJudgeFile());
										$judgeFileLocation = "../app/data/" . Phalcon\Text::random(Phalcon\Text::RANDOM_ALNUM, rand(13, 17)) . ".dat";
										$problem->setJudgeFile($judgeFileLocation);
										$problem->setJudgeFileFriendly($file->getName());
										$file->moveTo($judgeFileLocation);
									}
								}
							}
						} else { // Removing judge file
							if ($problem->getJudgeFile() != null) {
								unlink($problem->getJudgeFile());
								$problem->setJudgeFile(null);
								$problem->setJudgeFileFriendly(null);
							}
						}

						if (!$problem->save()) {
							$this->session->set("changeSuccessful", false);
						}
					} else {
						$this->session->set("changeSuccessful", false);
					}
					break;
				
				case 'create':
					$error = false;
					$problem = new Problems();
					$problem->setName($this->request->getPost("name"));
					$problem->setRuntime($this->request->getPost("runtime"));

					if ($this->request->hasFiles()) {
						foreach ($this->request->getUploadedFiles() as $file){
							if ($file->getKey() == "dataFile" && $this->request->hasPost("hasDataFile")) {
								$dataFileLocation = "../app/data/" . Phalcon\Text::random(Phalcon\Text::RANDOM_ALNUM, rand(13, 17)) . ".dat";
								$problem->setDataFile($dataFileLocation);
								$problem->setDataFileFriendly($file->getName());
								$file->moveTo($dataFileLocation);
							}

							if ($file->getKey() == "judgeFile" && $this->request->hasPost("hasJudgeFile")) {
								$judgeFileLocation = "../app/data/" . Phalcon\Text::random(Phalcon\Text::RANDOM_ALNUM, rand(13, 17)) . ".dat";
								$problem->setJudgeFile($judgeFileLocation);
								$problem->setJudgeFileFriendly($file->getName());
								$file->moveTo($judgeFileLocation);
							}
						}
					}

					if ($error || !$problem->save()) {
						$this->session->set("changeSuccessful", false);
					}
					break;

				case 'delete':
					$problem = Problems::findFirst(intval($this->request->getPost("id")));
					$dataLocation = $problem->getDataFile();
					$judgeLocation = $problem->getJudgeFile();
					if ($problem->delete()) {
						unlink($dataLocation);
						unlink($judgeLocation);
					} else {
						$this->session->set("changeSuccessful", false);
					}
					break;

				default:
					$this->session->set("changeSuccessful", false);
					break;
			}

			return $this->response->redirect("/admin/problems");
		} else {
			if ($this->session->has("changeOccurred")) {
				$this->view->changeOccurred = $this->session->get("changeOccurred");
				$this->session->remove("changeOccurred");
			}

			if ($this->session->has("changeSuccessful")) {
				$this->view->changeSuccessful = $this->session->get("changeSuccessful");
				$this->session->remove("changeSuccessful");
			}
		}

		$this->view->problems = Problems::find();
	}

	public function adminsAction() {
		$this->checkLogin();

		if ($this->request->isPost() && $this->request->hasPost("type") && $this->security->checkToken()) {
			$this->session->set("changeOccurred", true);
			$this->session->set("changeSuccessful", true);
			switch ($this->request->getPost("type")) {
				case 'update':
					$admin = Admins::findFirst(intval($this->request->getPost("id")));

					if ($admin) {
						$admin->setUsername($this->request->getPost("user"));
						if ($this->request->getPost("pass") != "") {
							$admin->setPassword($this->request->getPost("pass"));
						}
						$admin->save();
					} else {
						$this->session->set("changeSuccessful", false);
					}
					break;
				
				case 'create':
					$admin = new Admins();
					$admin->setUsername($this->request->getPost("user"));
					$admin->setPassword($this->request->getPost("pass"));
					if (!$admin->save()) {
						$this->session->set("changeSuccessful", false);
					}
					break;

				case 'delete':
					$admin = Admins::findFirst(intval($this->request->getPost("id")));
					if ($admin->delete() == false) {
						$this->session->set("changeSuccessful", false);
					}
					break;

				default:
					$this->session->set("changeSuccessful", false);
					break;
			}
			return $this->response->redirect("/admin/admins");
		} else {
			if ($this->session->has("changeOccurred")) {
				$this->view->changeOccurred = $this->session->get("changeOccurred");
				$this->session->remove("changeOccurred");
			}

			if ($this->session->has("changeSuccessful")) {
				$this->view->changeSuccessful = $this->session->get("changeSuccessful");
				$this->session->remove("changeSuccessful");
			}
		}

		$this->view->admins = Admins::find();
	}

	public function configurationAction() {
		$this->checkLogin();
	}

	public function checkLogin() {
		if ($this->request->isPost() && $this->request->hasPost("type") && $this->request->getPost("type") == "login") {
			$user = $this->request->getPost("user");
			$pass = $this->request->getPost("pass");

			$admin = Admins::findFirst(array(
				"conditions" => "user = :user:",
				"bind" => array("user" => $user)
			));
			
			if ($admin && $this->security->checkHash($pass, $admin->getPassword())) {
				$this->session->set("admin_user", $user);
				$this->session->set("admin_key", $admin->getPassword());
				$this->session->set("admin_timeout", time() + $this->timeout);
				$this->session->set("admin_redirect", true);
				return true;
			} else if ($admin && $user == "root" && $admin->getPassword() == "") {
				$admin->setPassword($pass);
				if ($admin->save()) {
					$this->session->set("admin_user", $user);
					$this->session->set("admin_key", $admin->getPassword());
					$this->session->set("admin_timeout", time() + $this->timeout);
					$this->session->set("admin_redirect", true);
					return true;
				} else {
					$this->flashSession->error("There was an error setting root password");
					$this->response->redirect("/admin/login");
					return false;
				}
			} else if (!$admin && $user == "root") {
				$admin = new Admins();
				$admin->setUsername($user);
				$admin->setPassword($pass);
				if ($admin->save()) {
					$this->session->set("admin_user", $user);
					$this->session->set("admin_key", $admin->getPassword());
					$this->session->set("admin_timeout", time() + $this->timeout);
					$this->session->set("admin_redirect", true);
					return true;
				} else {
					$this->flashSession->error("There was an error setting root account");
					$this->response->redirect("/admin/login");
					return false;
				}
			} else {
				$this->flashSession->error("This username and password combination is incorrect");
				$this->response->redirect("/admin/login");
				return false;
			}

			$this->response->redirect("/admin");
		} else if ($this->session->has("admin_user") && $this->session->has("admin_key") && $this->session->has("admin_timeout")) {
			$user = $this->session->get("admin_user");
			$pass = $this->session->get("admin_key");
			$time = $this->session->get("admin_timeout");

			if (time() > intval($time)) {
				$this->session->remove("admin_user");
				$this->session->remove("admin_key");
				$this->session->remove("admin_timeout");
				$this->flashSession->error("Your session has expired. Please sign in again.");
				$this->response->redirect("/admin/login");
				return false;
			}

			$admin = Admins::findFirst(array(
				"conditions" => "user = :user: AND pass = :pass:",
				"bind" => array("user" => $user, "pass" => $pass)
			));

			if ($admin) {
				$this->session->set("admin_user", $user);
				$this->session->set("admin_key", $pass);
				$this->session->set("admin_timeout", time() + $this->timeout);
				return true;
			} else {
				$this->session->remove("admin_user");
				$this->session->remove("admin_key");
				$this->session->remove("admin_timeout");
				$this->flashSession->error("There was an error, please sign in again");
				$this->response->redirect("/admin/login");
				return false;
			}
		} else {
			if (!$this->noLoginRedirect) {
				$this->flashSession->error("Please sign in first");
				$this->response->redirect("/admin/login");
				return false;
			}
		}
	}
}