<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Agent extends Layout {

	public function __construct(){
		parent::__construct();
		$this->load->model('commission');
	}

	public function index()
	{
	
		$this->main_layout('pages/logins/agent');
		
	}

	public function register(){
		$this->main_layout('pages/registration/agent');

	}

	public function get_commission(){
		$code = $this->uri->segment(3);
		$data['commission'] = $this->commission->agent_commission($code);
		// $this->output->enable_profiler(TRUE);
		$this->dashboard_layout('pages/dashboard/agent', $data );
	}

}
