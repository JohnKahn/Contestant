<?php

use Phalcon\Mvc\Controller;

class TeamController extends Controller {

	private $timeout = 21600;

	public function indexAction() {
		$this->checkLogin();
		$this->view->teams = Teams::find();
		$this->view->problems = Problems::find();
		$this->view->serverFiles = ServerFiles::find(array("order" => "friendlyName"));
	}

	public function submitAction() {

	}

	public function editorAction() {
		
	}

	public function clarificationAction() {
		
	}

	public function newServerFileAction() {
		if ($this->request->isPost() && $this->request->isAjax()) {
			$data = array();

			$filename = $this->request->getPost("filename");
			if (!Phalcon\Text::endsWith($filename, ".java")) {
				$filename .= ".java";
			}

			$team_id = $this->request->getPost("team_id");

			$cond = "friendlyName = :friendlyName: AND team_id = :team_id:";
			$para = array("friendlyName" => $filename, "team_id" => $team_id);
			$serverFile = ServerFiles::findFirst(array($cond, "bind" => $para));

			if ($serverFile) {
				$data["success"] = false;
				$data["message"] = "You already have a file with that name";
				echo json_encode($data);
				return;
			}

			$name = Phalcon\Text::random(Phalcon\Text::RANDOM_ALNUM, rand(13, 17));
			
			$serverFile = new ServerFiles();
			$serverFile->setTeam(Teams::findFirst($team_id));
			$serverFile->setFriendlyName($filename);
			$serverFile->setPath("../app/data/{$name}");
			$serverFile->setLastSave($this->request->getPost("lastSave"));

			if ($serverFile->save() && fopen($serverFile->getPath(), "w")) {
				$data["success"] = true;
				$data["friendlyName"] = $serverFile->getFriendlyName();
			} else {
				$serverFile->delete();
				$data["success"] = false;
				$data["message"] = "There was an error saving your file. Please try again.";
				echo json_encode($data);
				return;
			}

			echo json_encode($data);
			return;
		}
	}

	public function saveServerFileAction() {
		if ($this->request->isPost() && $this->request->isAjax()) {
			$data = array();

			$filename = $this->request->getPost("filename");
			$team_id  = $this->request->getPost("team_id");
			$content  = $this->request->getPost("content");
			$lastSave = $this->request->getPost("lastSave");

			$cond = "friendlyName = :friendlyName: AND team_id = :team_id:";
			$para = array("friendlyName" => $filename, "team_id" => $team_id);
			$serverFile = ServerFiles::findFirst(array($cond, "bind" => $para));

			if (!$serverFile) {
				$data["success"] = false;
				echo json_encode($data);
				return;
			}

			$serverFile->setLastSave($lastSave);

			$file = fopen($serverFile->getPath(), "w");
			if ($file) {
				if (($content == "" || fwrite($file, $content)) && $serverFile->save()) {
					$data["success"] = true;
				} else {
					$data["success"] = false;
					echo json_encode($data);
					return;
				}
			} else {
				$data["success"] = false;
				echo json_encode($data);
				return;
			}

			echo json_encode($data);
			return;
		}
	}

	public function deleteServerFileAction() {
		if ($this->request->isPost() && $this->request->isAjax()) {
			$data = array();

			$filename = $this->request->getPost("filename");
			$team_id  = $this->request->getPost("team_id");

			$cond       = "friendlyName = :friendlyName: AND team_id = :team_id:";
			$para       = array("friendlyName" => $filename, "team_id" => $team_id);
			$serverFile = ServerFiles::findFirst(array($cond, "bind" => $para));

			if (!$serverFile) {
				$data["success"] = false;
				echo json_encode($data);
				return;
			}

			if (unlink($serverFile->getPath())) {
				if ($serverFile->delete()) {
					$data["success"] = true;
				} else {
					$data["success"] = false;
					echo json_encode($data);
					return;
				}
			} else {
				$data["success"] = false;
				echo json_encode($data);
				return;
			}

			echo json_encode($data);
			return;
		}
	}

	public function checkLogin() {
		if ($this->request->isPost()) {
			$user = $this->request->getPost("user");
			$pass = $this->request->getPost("pass");

			$team = Teams::findFirst(array(
				"conditions" => "user = :user:",
				"bind" => array("user" => $user)
			));
			if ($team && $this->security->checkHash($pass, $team->getPassword())) {
				$this->session->set("team_user", $user);
				$this->session->set("team_id", $team->getId());
				$this->session->set("team_key", $team->getPassword());
				$this->session->set("team_timeout", time() + $this->timeout);
			} else {
				$this->flashSession->error("This username and password combination is incorrect");
				return $this->response->redirect("");
			}

			$this->response->redirect("/team");
		} else if ($this->session->has("team_user") && $this->session->has("team_user") && $this->session->has("team_timeout") && $this->session->get("team_id")) {
			$user = $this->session->get("team_user");
			$id   = $this->session->get("team_id");
			$pass = $this->session->get("team_key");
			$time = $this->session->get("team_timeout");

			if (time() > intval($time)) {
				$this->session->remove("team_user");
				$this->session->remove("team_id");
				$this->session->remove("team_key");
				$this->session->remove("team_timeout");
				$this->flashSession->error("Your session has expired. Please sign in again.");
				return $this->response->redirect("");
			}

			$team = Teams::findFirst(array(
				"conditions" => "user = :user: AND pass = :pass:",
				"bind" => array("user" => $user, "pass" => $pass)
			));

			if ($team) {
				$this->session->set("team_user", $user);
				$this->session->set("team_id", $id);
				$this->session->set("team_key", $pass);
				$this->session->set("team_timeout", time() + $this->timeout);
			} else {
				$this->flashSession->error("There was an error, please sign in again");
				return $this->response->redirect("");
			}
		} else {
			$this->flashSession->error("Please sign in first");
			return $this->response->redirect("");
		}
	}
}