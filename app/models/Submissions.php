<?php

use Phalcon\Mvc\Model;

class Submissions extends Model {
	protected $id;         // id
	protected $team_id;    // id of the team that submitted this
	protected $problem_id; // id of the problem that was submitted
	protected $time;       // the time that this was submitted
	protected $response;   // the response, if any, for this submission

	public function initialize() {
		$this->belongsTo("team_id", "Teams", "id");
		$this->belongsTo("problem_id", "Problems", "id");
	}
}