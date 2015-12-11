<?php

use Phalcon\Mvc\Model;

class Problems extends Model {
	protected $id;      // id
	protected $name;    // name
	protected $runtime; // max runtime allowed
	protected $output;  // location of the output file

	public function initialize() {
		$this->hasMany("id", "Submissions", "problem_id");
	}
}