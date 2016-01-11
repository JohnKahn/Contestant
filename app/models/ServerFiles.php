<?php

use Phalcon\Mvc\Model;

class ServerFiles extends Model {
	protected $id;           // id (int)
	protected $team_id;      // team that this file belongs to (string)
	protected $friendlyName; // friendly file name (string)
	protected $name;         // file name that the server uses (string)
	protected $lastSave;     // last save time (string)

	public function initialize() {
		$this->belongsTo("team_id", "Teams", "id");
	}

	public function getId() {
		return $this->id;
	}

	public function setTeam($newTeam) {
		$this->team_id = $newTeam->getId();
	}

	public function getFriendlyName() {
		return $this->friendlyName;
	}

	public function setFriendlyName($newFriendlyName) {
		$this->friendlyName = $newFriendlyName;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($newName) {
		$this->name = $newName;
	}

	public function getFileContents() {
		return file_get_contents("../data/{$this->name}");
	}

	public function getFileContentsEscaped() {
		return str_replace("\t", "\\t", str_replace("\n", "\\n", $this->getFileContents()));
	}
}