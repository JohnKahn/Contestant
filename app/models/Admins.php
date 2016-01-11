<?php

use Phalcon\Mvc\Model;
use Phalcon\Security;

class Admins extends Model {
	protected $id;   // id
	protected $user; // username
	protected $pass; // password (hashed)

	public function getId() {
		return $this->id;
	}

	public function getUsername() {
		return $this->user;
	}

	public function setUsername($newUsername) {
		$this->user = $newUsername;
	}

	public function getPassword() {
		return $this->pass;
	}

	public function setPassword($newPassword) {
		$security = new Security();
		$this->pass = $security->hash($newPassword);
	}
}