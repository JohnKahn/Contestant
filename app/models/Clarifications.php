<?php

use Phalcon\Mvc\Model;

class Clarifications extends Model {
	protected $id;         // id
	protected $team_id;    // team id
	protected $problem_id; // problem id
	protected $urgency;    // the urgency level
	protected $time;       // submission time
	protected $response;   // reply from admins

	public function initialize() {
		$this->belongsTo("team_id", "Teams", "id");
		$this->belongsTo("problem_id", "Problems", "id");
	}
}