<?php

use Phalcon\Mvc\Model;

class ServerFiles extends Model {
	protected $id;           // id (int)
	protected $team_id;      // team that this file belongs to (string)
	protected $friendlyName; // friendly file name (string)
	protected $path;         // file name that the server uses (string)
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

	public function getFriendlyNameNoExtension() {
		$temp = explode(".", $this->friendlyName);
		unset($temp[count($temp) - 1]);
		return implode(".", $temp);	
	}

	public function setFriendlyName($newFriendlyName) {
		$this->friendlyName = $newFriendlyName;
	}

	public function getPath() {
		return $this->path;
	}

	public function setPath($newPath) {
		$this->path = $newPath;
	}

	public function getFileContents() {
		return file_get_contents($this->path);
	}

	public function getFileContentsEscaped() {
		return str_replace('"', '\"', str_replace("\t", "\\t", str_replace("\n", "\\n", $this->getFileContents())));
	}

	public function getLastSave() {
		return $this->lastSave;
	}

	public function setLastSave($newLastSave) {
		$this->lastSave = $newLastSave;
	}
}