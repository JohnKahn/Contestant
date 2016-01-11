<?php

use Phalcon\Mvc\Controller;

class TeamController extends Controller {

	private $timeout = 21600;

	public function initialize() {
		if ($this->request->isPost()) {
			$user = $this->request->getPost("user");
			$pass = $this->request->getPost("pass");

			$team = Teams::findFirst(array(
				"conditions" => "user = :user:",
				"bind" => array("user" => $user)
			));
			if ($team && $this->security->checkHash($pass, $team->getPassword())) {
				$this->session->set("team_user", $user);
				$this->session->set("team_key", $team->getPassword());
				$this->session->set("team_timeout", time() + $this->timeout);
			} else {
				$this->flashSession->error("This username and password combination is incorrect");
				return $this->response->redirect("");
			}

			$this->response->redirect("/team");
		} else if ($this->session->has("team_user") && $this->session->has("team_user") && $this->session->has("team_timeout")) {
			$user = $this->session->get("team_user");
			$pass = $this->session->get("team_key");
			$time = $this->session->get("team_timeout");

			if (time() > intval($time)) {
				$this->session->remove("team_user");
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

	public function indexAction() {
		$this->view->teams = Teams::find();
		$this->view->problems = Problems::find();
	}

	public function submitAction() {
		
	}

	public function editorAction() {
		
	}

	public function clarificationAction() {
		
	}
}