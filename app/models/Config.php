<?php

use Phalcon\Mvc\Model;

class Config extends Model {
	protected $id;    // id
	protected $keyy;  // key for the setting
	protected $type;  // the type of the setting (int, double, boolean, string)
	protected $value; // the value of the setting (will be of the type specified)
}