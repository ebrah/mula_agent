<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Agent extends Layout {

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
	
		$this->main_layout('pages/logins/agent');
		
	}

	public function register(){
		$this->main_layout('pages/registration/agent');

	}

}
