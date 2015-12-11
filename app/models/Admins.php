<?php

use Phalcon\Mvc\Model;

class Admins extends Model {
	protected $id;   // id
	protected $user; // username
	protected $pass; // password (hashed)
}