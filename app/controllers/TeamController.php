<?php

use Phalcon\Mvc\Controller;
use Phalcon\Filter;

class TeamController extends Controller {

	public function indexAction() {
		
	}

	public function loginAction() {
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

			$team = Teams::findFirstByUser($user);
			if ($team && $this->security->checkHash($pass, $team->getPassword())) {
				$this->session->set("team", $user);
			} else {
				$this->flashSession->error("This username and password combination is incorrect");
				return $this->response->redirect("");
			}

			$this->response->redirect("/team");
		}
	}

	public function submitAction() {
		
	}

	public function editorAction() {
		
	}

	public function clarificationAction() {
		
	}
}