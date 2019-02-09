<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Agent extends Layout {

	public function __construct(){
		parent::__construct();
		$this->load->model('commission');
		$this->load->model('user');
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

	public function signout(){
		$this->session->sess_destroy();
		redirect(base_url().'agent');
	}

	public function get_agents(){
		$data['agents'] = $this->user->get();
		$this->dashboard_layout('pages/dashboard/agents', $data);
	}
	
	public function activate(){
		$id = $this->uri->segment(3);
		$n = $this->user->update([ 'active' => TRUE ], $id);
		if($n > 0){
			$this->get_agents();
		}
	}
	public function deactivate(){
		$id = $this->uri->segment(3);
		$n = $this->user->update([ 'active' => FALSE ], $id);
		if($n > 0){
			$this->get_agents();
		}
		
	}
	public function delete(){
		$arr = $this->uri->uri_to_assoc();
		$n1 = $this->user->delete($arr['id']);
		$this->db->where(['agentcode' => $arr['code']]);
		$this->db->delete('commission');
		$n = $this->db->affected_rows();
		if($n > 0 || $n1 > 0 ){
			$this->get_agents();
		}
	}
}
