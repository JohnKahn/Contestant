<?php

use Phalcon\Mvc\Model;

class Problems extends Model {
	protected $id;                // id
	protected $name;              // name
	protected $runtime;           // max runtime allowed
	protected $dataFile;          // location of the data file
	protected $dataFileFriendly;  // File name of the original data file uploaded
	protected $judgeFile;         // location of the judge file
	protected $judgeFileFriendly; // File name of the original data file uploaded

	public function initialize() {
		$this->hasMany("id", "Submissions", "problem_id");
	}

	function getId() {
		return $this->id;
	}

	function getName() {
		return $this->name;
	}

	function setName($newName) {
		$this->name = $newName;
	}

	function getRuntime() {
		return $this->runtime;
	}

	function setRuntime($newRuntime) {
		$this->runtime = $newRuntime;
	}

	function getDataFile() {
		return $this->dataFile;
	}

	function setDataFile($newDataFile) {
		$this->dataFile = $newDataFile;
	}

	function getDataFileFriendly() {
		return $this->dataFileFriendly;
	}

	function setDataFileFriendly($newDataFileFriendly) {
		$this->dataFileFriendly = $newDataFileFriendly;
	}

	function getJudgeFile() {
		return $this->judgeFile;
	}

	function setJudgeFile($newJudgeFile) {
		$this->judgeFile = $newJudgeFile;
	}

	function getJudgeFileFriendly() {
		return $this->judgeFileFriendly;
	}

	function setJudgeFileFriendly($newJudgeFileFriendly) {
		$this->judgeFileFriendly = $newJudgeFileFriendly;
	}
}