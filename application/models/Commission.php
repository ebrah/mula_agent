<?php
 class Commission extends Crud_model{
     protected $_table = 'commission';
     protected $_primary_key = 'id';

     public function __constructor(){
         parent::__constructor();
     }

    //insert commission
     public function insert_new_commission($data){
            if($this->db->insert($this->_table, $data)){
                $code = $data['agentcode'];
                $date = $data['date'];
                $commission = $data['total_commission'];
                $this->insert_weekly_commission($date, $code, $commission);

            }else{
                die(' fail to insert commission ');
            }
            //return $this->db->insert_id();   
     }


      //generate start date and end date of a week in specific date.
     function getWeekDates($date)
      {
            $year = date('Y', strtotime($date));
            $week = date('W', strtotime($date));
            $start = date("Y-m-d", strtotime("{$year}-W{$week}-1")); //Returns the date of monday in week
            $end = date("Y-m-d", strtotime("{$year}-W{$week}-7"));   //Returns the date of sunday in week
        
            return [ 'start' => $start, 'end'=> $end ];
      }




     public function insert_weekly_commission($date, $code, $commission ){
        $n_date = $this->getWeekDates($date);
        $result = $this->fetch_('weekly', ['agentcode' => $code, 
               'start_week_date' => $n_date['start'],
               'end_week_date' => $n_date['end']
        ]);
        // echo '<pre>';
        // echo 'result after fetch specific agent code';
        // print_r($result);

        if(empty($result)){
             $new_date = $this->getWeekDates($date);
            //new insert
            $r = $this->insert_weekly([
                'start_week_date' => $new_date['start'],
                'end_week_date' => $new_date['end'],
                'agentcode' => $code,
                'weekly_commission' => $commission
            ]);
             
            if($r){
                $this->session->set_flashdata('SUCCESS', 'Successfuly commission added!.');
                redirect(base_url().'admin/dashboard');
            }else{
                die('fail to insert new weekly commmission');
            }; 
            
        }else{
            $affected = 0;
            //update
            foreach ($result as $value) {
                $start_date = $value->start_week_date;
                $end_date = $value->end_week_date;
                $weekly_c = $value->weekly_commission;

                if($date > $start_date  && $date < $end_date){
                    $affected = $this->update_week([
                        'weekly_commission' => ($weekly_c + $commission)
                    ],[
                         'start_week_date' => $start_date,
                         'end_week_date' => $end_date
                    ]);
                }
            }

        //   echo 'affected results ';
        //   print_r($affected);

          if($affected){
            $this->session->set_flashdata('SUCCESS', 'Successfuly commission added!.');
            redirect(base_url().'admin/dashboard');
          }else{
              die('fail to update weekly commmission');
          }; 

        }
     }

     public function insert_weekly($data){
          if(!is_array($data)){
              die( ' passed paramer of insert_weekly() should be array');
          }
         $result = $this->db->insert('weekly', $data);
         return $result;
     }

      //update weekly commission
     public function update_week($data, $where){
         
            if(is_array($where)){
              foreach ($where as $key => $value) {
                  $this->db->where($key, $value);
              }
            }else{
                die('You must pass a second parameter to update()');
            }
   
            $this->db->update('weekly', $data);
            return $this->db->affected_rows();
    }

     //commission for specific agent
     public function agent_commission($code){

            $bucket = [];
            $week= [];
            if(is_numeric($code)){
                $w_comm = $this->fetch_('weekly', [' agentcode' => $code ]);
               
                foreach ($w_comm as $comm ) {
                    $week = [];
                    $this->db->order_by('date');
                  $result = $this->get([ 
                      'agentcode' => $comm->agentcode,
                      'date >=' => $comm->start_week_date,
                      'date <=' => $comm->end_week_date
                  ]);

                  foreach ($result as $value) {
                       $week [] = $value;
                  }
          
                  $bucket[] = [ 'weekly' => $week, 'week_commission' => $comm->weekly_commission ];
                }

                return $bucket;
            }

      }

    public function fetch_total_wk_comm($data){
        $this->db->select('weekly_commission');
        $this->db->where([
            'start_week_date <=' => $data['date'],
            'end_week_date >= ' => $data['date'],
            'agentcode' => $data['agentcode']
        ]);
        $res_ = $this->db->get('weekly');
        return $res_->result();
    }

     //editing commission
     public function submit_edited_comm($data, $id){
       
        $r = $this->update($data, $id['id']);
        if($r > 0){

            // $this->db->select('weekly_commission');
            // $this->db->where([
            //     'start_week_date <=' => $id['date'],
            //     'end_week_date >= ' => $id['date'],
            //     'agentcode' => $id['agentcode']
            // ]);
            $res_ = fetch_total_wk_comm(['date' => $id['date'], 'agentcode' => $id['agentcode']]);

            $oldamount = 0;

            foreach($res_ as $value) {
                $oldamount = $value->weekly_commission;
            } 
           
            $new_amount = ($data['total_commission'] + $oldamount) - $id['amount'];

            $this->db->where([
                'start_week_date <=' => $id['date'],
                'end_week_date >= ' => $id['date'],
                'agentcode' => $id['agentcode']
            ]);

            $new_date = $this->getWeekDates($data['date']);

            $this->db->update('weekly', [
                'start_week_date' => $new_date['start'],
                'end_week_date' => $new_date['end'],
                'agentcode' => $data['agentcode'],
                'weekly_commission' => $new_amount
            ]);

            if($this->db->affected_rows() > 0){
               //redirect
               redirect(base_url()."admin/dashboard");
            }
        }else{
            die('does not affect any row');
        }
     }

   public function delete_weekly_comm($data){
         $check_date = $this->getWeekDates($data['date']);
         $old = $this->fetch_total_wk_comm(['date' => $data['date'], 'agentcode' => $data['agentcode']]);
          if(empty($old)){
             die('The weekly commission is not available');
          }
          foreach ($old as $o) {
             $old_amount =  $o->weekly_commission;
          }

          $this->db->where([
            'start_week_date' => $check_date['start'],
            'end_week_date' => $check_date['end'],
            'agentcode' => $data['agentcode']
          ]);

         $this->db->update('weekly', [
            'weekly_commission' => ($old_amount - $data['total_commission'])
        ]);

        //delete weekly_commission if equal to 0
        $old_w = $this->fetch_total_wk_comm(['date' => $data['date'], 'agentcode' => $data['agentcode']]);

        foreach ($old_w as $w ) {
           if($w->weekly_commission == 0 OR $w->weekly_commission <= 0 ){
              //delete this
              $this->db->where([
                  'agentcode' => $data['agentcode'],
                  'start_week_date' => $check_date['start'],
                  'end_week_date' => $check_date['end']
              ]);
              $this->db->delete('weekly');
           }
        }
   }


   public function toggle_fk($bol){
       if($bol){
           $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
       }else{
          $this->db->query('SET FOREIGN_KEY_CHECKS = 1');  
       }
   }

 
 }


?>