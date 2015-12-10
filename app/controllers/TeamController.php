<?php

use Phalcon\Mvc\Controller;

class TeamController extends Controller {

    public function indexAction() {
    	
    }

    public function loginAction() {
    	$user = $this->request->getPost("user");
    	$pass = $this->request->getPost("pass");

    	// Validate that they belong here and set a session variable!

		$this->response->redirect("/team");
    }

    public function submitAction() {
    	
    }

    public function editorAction() {
        
    }
}