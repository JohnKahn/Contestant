<?php

use Phalcon\Mvc\Model;

class Teams extends Model {
	protected $id;   // id
	protected $user; // username
	protected $pass; // password (hashed)

	public function initialize() {
		$this->hasMany("id", "Submissions", "team_id");
	}

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