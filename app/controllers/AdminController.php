<?php

use Phalcon\Mvc\Controller;
use Phalcon\Filter;

class AdminController extends Controller {

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
			$this->flashSession->error("Please sign in first");
			return $this->response->redirect("/admin/login");
		}
    }

    public function loginAction() {
    	if (!$this->flashSession->has("error") && $this->session->has("admin_user")) {
    		return $this->response->redirect("/admin");
    	}
    }

    public function logoutAction() {
    	if ($this->session->has("admin_user")) {
    		$this->session->remove("admin_user");
    		$this->session->remove("admin_key");
    		$this->session->remove("admin_timeout");
    	}

    	return $this->response->redirect("/admin/login");
    }
}