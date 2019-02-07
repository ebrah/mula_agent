<?php 

  class Admin extends Layout{

      public function __construct(){
          parent::__construct();
          $this->load->model('user');
      }

      public function dashboard(){
         $this->main_layout('pages/dashboard/admin');
      }

      public function login(){
         $this->main_layout('pages/logins/admin');
      }

      public function do_login(){
         $email = $this->input->post('email');
         $password = $this->input->post('password');

         $result = $this->user->get(array( 
               'email' => $email
         ));

         if(empty($result)){
            $this->session->set_flashdata('FAIL', 'Invalid credential entered!.');
            redirect(base_url().'admin/login');
         }

         foreach ($result as $row)
         {    
               if(password_verify($password, $row->password)){
                  $this->session->set_flashdata('SUCCESS', 'Welcome!.');
                  $this->session->set_userdata(array(
                     'user_id' => $row->id,
                     'email' => $row->email
                  ));
                  $this->dashboard();
               }else{
                  $this->session->set_flashdata('FAIL', 'Invalid credential entered!.');
                  redirect(base_url().'admin/login');
               }
         }

         // $this->output->enable_profiler(TRUE);
      }

      public function register(){
        $this->main_layout('pages/registration/admin');
      }
   
      public function ad_register(){
      
       $email = $this->input->post('email');
       $password = $this->input->post('password');

        $no = $this->user->insert(array(
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'agent' => FALSE,
            'active' => TRUE
         ));

         if($no ){
            $this->session->set_flashdata('SUCCESS', 'You are successful registered.');
         }else{
            $this->session->set_flashdata('FAIL', 'Registration fail. Email already used.');
            redirect(base_url()."admin/register");
         }
          redirect(base_url()."admin/login");
      }

     public function get_admins(){
         $result = $this->user->get();
         echo '<pre>';
         print_r($result);
     }
    
     public function delete_admin(){
       $result =  $this->user->delete(array(
            'email' => 'jameebrav@gmail.com'
        ));

        echo '<pre>';
        print_r($result);
     }

   //   public function index(){
   //      $this->output->enable_profiler(TRUE);
   //   }

  }
?>