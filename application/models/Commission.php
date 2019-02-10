<?php
 class Commission extends CRUD_model{
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
        $result = $this->fetch_('weekly', ['agentcode' => $code ]);
        echo '<pre>';
        echo 'result after fetch specific agent code';
        print_r($result);

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

          echo 'affected results ';
          print_r($affected);

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
        
            if(is_numeric($code)){
                $ql = "SELECT c.id, c.date, c.agentcode, c.startimes, c.azamtv, c.halotel, c.ttcl, c.dstv, c.total_commission, w.weekly_commission
                FROM commission c INNER JOIN weekly w ON c.agentcode = w.agentcode WHERE c.agentcode = ". $this->db->escape($code) . "";
                
                $result = $this->db->query($ql);
                return $result->result();
            }

      }

     //editing commission
     public function submit_edited_comm($data, $id){
       
        $r = $this->update($data, $id['id']);
        if($r > 0){

            $this->db->select('weekly_commission');
            $this->db->where([
                'start_week_date <=' => $id['date'],
                'end_week_date >= ' => $id['date'],
                'agentcode' => $id['agentcode']
            ]);
            $res_ = $this->db->get('weekly');

            $oldamount = 0;

            foreach($res_->result() as $value) {
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
 
 }
?>