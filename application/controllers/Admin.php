<?php 

  class Admin extends Layout{

      public function __construct(){
          parent::__construct();
          $this->load->model('user');
          $this->load->model('commission');
          $this->load->model('price_model');
      }

      public function dashboard(){
         $data['commission'] = $this->commission->get('','date','','');
         $this->dashboard_layout('pages/dashboard/admin', $data);
      }

      public function login(){
         $this->main_layout('pages/logins/admin');
      }

      public function do_login(){
         $ag = $this->uri->segment(3);

         $email = $this->input->post('email');
         $password = $this->input->post('password');

         $result = $this->user->get(array( 
               'email' => $email
         ), '', '', '');

         if(empty($result)){
            $this->session->set_flashdata('FAIL', 'Invalid credential entered!.');
            ($ag == 'agent')? redirect(base_url().'agent') : redirect(base_url().'admin/login');
         }

         foreach ($result as $row)
         {    
               if(password_verify($password, $row->password)){
                  $this->session->set_flashdata('SUCCESS', 'Welcome!.');
                  $this->session->set_userdata(array(
                     'user_id' => $row->id,
                     'email' => $row->email,
                     'agent' => $row->agent,
                     'active' => $row->active
                  ));
                  
                  ($row->agent == 1)? redirect(base_url().'agent/get_commission/'.$row->code) : $this->dashboard();
               }else{
                  $this->session->set_flashdata('FAIL', 'Invalid credential entered!.');
                  ($row->agent == 1)? redirect(base_url().'agent') : redirect(base_url().'admin/login');
               }
         }

         // $this->output->enable_profiler(TRUE);
      }

      public function register(){
        $this->main_layout('pages/registration/admin');
      }
   
      public function ad_register(){

        $ag = $this->uri->segment(3);

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if($ag == 'agent'){
         $code = $this->input->post('agentcode');
            
         $no = $this->user->insert(array(
            'code' => $code,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'agent' => TRUE,
            'active' => TRUE
         ));
   
        }else{
            
         $no = $this->user->insert(array(
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'agent' => FALSE,
            'active' => TRUE
         ));
   
        }

         if($no ){
            $this->session->set_flashdata('SUCCESS', 'You are successful registered.');
         }else{
            $this->session->set_flashdata('FAIL', 'Registration fail. Email already used.');
            ($ag == 'agent')? redirect(base_url()."agent/register") : redirect(base_url()."admin/register");
         }
         
         ($ag == 'agent')? redirect(base_url()."agent") : redirect(base_url()."admin/login");
      }

     public function get_admins(){
         $result = $this->user->get();
         // echo '<pre>';
         // print_r($result);
     }
    
     public function delete_admin(){
       $result =  $this->user->delete(array(
            'email' => ''
        ));
     }

   public function commission_form(){
      $data['prices'] = $this->price_model->get();
      $this->dashboard_layout('pages/dashboard/commission_form', $data);

   }

   public function add_commission(){

      $date = $this->input->post('date');
      $agentcode = $this->input->post('agentcode');
      $halotel = $this->input->post('halotel');
      $dstv = $this->input->post('dstv');
      $ttcl = $this->input->post('ttcl');
      $startimes = $this->input->post('startimes');
      $commission = $this->input->post('commission');
      $azamtv = $this->input->post('azamtv');


      $this->commission->insert_new_commission([
          'date' =>  $date,
          'agentcode' =>  $agentcode,
          'startimes' => $startimes,
          'azamtv' =>  $azamtv,
          'dstv' => $dstv,
          'ttcl' => $ttcl,
          'dstv' => $dstv,
          'halotel' => $halotel,
          'total_commission' => $commission
      ]);

   }

   public function edit_commission(){
       $id = $this->uri->segment(3);
       $data['comm'] = $this->commission->get($id);
       $this->dashboard_layout('pages/dashboard/edit_commission', $data);
        
   }

   public function edited_commission(){
      $id= $this->input->post('id');
      $date = $this->input->post('date');
      $agentcode = $this->input->post('agentcode');
      $halotel = $this->input->post('halotel');
      $dstv = $this->input->post('dstv');
      $ttcl = $this->input->post('ttcl');
      $startimes = $this->input->post('startimes');
      $commission = $this->input->post('commission');
      $azamtv = $this->input->post('azamtv');
      $prv_commission = $this->input->post('prv_commission');
      $prv_code = $this->input->post('prv_agentcode');
      $prv_date = $this->input->post('prv_date');

      $this->commission->submit_edited_comm([
         'date' =>  $date,
         'agentcode' =>  $agentcode,
         'startimes' => $startimes,
         'azamtv' =>  $azamtv,
         'dstv' => $dstv,
         'ttcl' => $ttcl,
         'dstv' => $dstv,
         'halotel' => $halotel,
         'total_commission' => $commission
      ],[
          'id' => $id,
          'amount' => $prv_commission,
          'date' => $prv_date,
          'agentcode' => $prv_code
      ]);

      // $this->output->enable_profiler(TRUE);
   }

   public function delete_commission(){
      $id = $this->uri->segment(3);
      $comm =  $this->commission->get($id);

      // echo '<pre>';
      // print_r($comm);

      if(empty($comm)){
         die(' I term requested to delete is not avaiable');
      }

      foreach ($comm as $c) {
         $date =   $c->date;
         $agentcode =   $c->agentcode;
         $total_commission =   $c->total_commission;
      }

      $this->commission->delete_weekly_comm([
         'date' => $date,
         'agentcode' => $agentcode,
         'total_commission' => $total_commission
      ]);

      $this->commission->toggle_fk(TRUE);
        $n =  $this->commission->delete($id);
      $this->commission->toggle_fk(TRUE);

      if($n > 0){
         $this->dashboard();
      }
   }

   public function change_price(){
      $price = [
         'startimes'=> $this->input->post('starPrice'),
         'azamtv' => $this->input->post('azamPrice'),
         'dstv' => $this->input->post('dstvPrice'),
         'halotel' => $this->input->post('halotelPrice'),
         'ttcl' => $this->input->post('ttclPrice')
      ];  

      $result = $this->price_model->update($price, $this->input->post('id'));
      redirect(base_url()."admin/commission_form");
   }

  }
?>