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
    
  }

?>