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
	}

	public function judgeAction() {
		$this->checkLogin();
	}

	public function teamsAction() {
		$this->checkLogin();

		if ($this->request->isPost() && $this->request->hasPost("type") && $this->security->checkToken()) {
			$this->session->set("changeOccurred", true);
			$this->session->set("changeSuccessful", true);
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
		}

		$this->view->teams = teams::find();
	}

	public function problemsAction() {
		$this->checkLogin();
	}

	public function adminsAction() {
		$this->checkLogin();
	}

	public function configurationAction() {
		$this->checkLogin();
	}

	public function checkLogin() {
		if ($this->request->isPost() && $this->request->hasPost("type") && $this->request->getPost("type") == "login") {
			$filter = new Filter();

			$filter->add('username', function ($value) {
				return preg_replace('/[^0-9a-zA-Z]/', '', $value);
			});

			$filter->add('password', function ($value) {
				return preg_replace('/[^0-9a-zA-Z!@#$%^&*]/', '', $value);
			});

			$user = $filter->sanitize($this->request->getPost("user"), "username");
			$pass = $filter->sanitize($this->request->getPost("pass"), "password");

			$admin = Admins::findFirst(array(
				"conditions" => "user = :user:",
				"bind" => array("user" => $user)
			));
			if ($admin && $this->security->checkHash($pass, $admin->getPassword())) {
				$this->session->set("admin_user", $user);
				$this->session->set("admin_key", $admin->getPassword());
				$this->session->set("admin_timeout", time() + $this->timeout);
			} else {
				$this->flashSession->error("This username and password combination is incorrect");
				return $this->response->redirect("/admin/login");
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
				return $this->response->redirect("/admin/login");
			}

			$admin = Admins::findFirst(array(
				"conditions" => "user = :user: AND pass = :pass:",
				"bind" => array("user" => $user, "pass" => $pass)
			));

			if ($admin) {
				$this->session->set("admin_user", $user);
				$this->session->set("admin_key", $pass);
				$this->session->set("admin_timeout", time() + $this->timeout);
			} else {
				$this->flashSession->error("There was an error, please sign in again");
				return $this->response->redirect("/admin/login");
			}
		} else {
			if (!$this->noLoginRedirect) {
				$this->flashSession->error("Please sign in first");
				return $this->response->redirect("/admin/login");
			}
		}
	}
}