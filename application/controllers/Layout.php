<?php

  class Layout extends CI_Controller{

    public function __construct(){
       parent::__construct();
    }

    public function main_layout($main){
      $this->load->view('components/header');
      $this->load->view($main);
      $this->load->view('components/footer');
    }

    public function dashboard_layout($main, $data = ''){
      $this->load->view('components/header_dashboard');
      $this->load->view('components/topnav');
      $this->load->view('components/sidenav');
      $this->load->view($main, $data);
      $this->load->view('components/footer_dashboard');
    }
    
  }

?>