<?php

use Phalcon\Mvc\Model;

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

	public function getPassword() {
		return $this->pass;
	}
}