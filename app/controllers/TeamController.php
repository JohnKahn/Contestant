<?php

use Phalcon\Mvc\Controller;
use Phalcon\Filter;

class TeamController extends Controller {

	private $timeout = 21600;

	public function indexAction() {
		if ($this->request->isPost()) {
			$filter = new Filter();

			$filter->add('username', function ($value) {
				return preg_replace('/[^0-9a-zA-Z]/', '', $value);
			});

			$filter->add('password', function ($value) {
				return preg_replace('/[^0-9a-zA-Z!@#$%^&*]/', '', $value);
			});

			$user = $filter->sanitize($this->request->getPost("user"), "username");
			$pass = $filter->sanitize($this->request->getPost("pass"), "password");

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

	public function submitAction() {
		
	}

	public function editorAction() {
		
	}

	public function clarificationAction() {
		
	}
}