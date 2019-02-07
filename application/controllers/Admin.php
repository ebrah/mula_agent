<?php 

  class Admin extends Layout{

      public function __constructor(){
          parent::__constructor();
          $this->load->model('user');
      }

      public function login(){
         $this->main_layout('pages/logins/admin');
      }

      public function register(){
        $this->main_layout('pages/registration/admin');
      }

      public function ad_register(){
    //  "     echo '<pre> admin details';
    //       echo $this->input->post('email');"

         $this->user->insert(array(
            'email' => 'jameebrav@gmail.com',
            'password' => '123jamee',
            'agent' => TRUE,
            'active' => TRUE
         ));

      }

     public function get_admins(){
         $this->load->model('user');
         $result = $this->user->get();

         echo '<pre>';
         print_r($result);
     }
    
     public function delete_admin(){
       $this->load->model('user');
       $result =  $this->user->delete(array(
            'email' => 'jameebrav@gmail.com'
        ));

        echo '<pre>';
        print_r($result);
     }

    //   public function index(){
    //       $this->output->enable_profiler(true);
    //   }

  }
?>