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

     public function insert_weekly_commission($date, $code, $commission ){
        $result = $this->fetch_('weekly', ['agentcode' => $code ]);
        if(empty($result)){
             $start_week = date('Y-m-d', strtotime('sunday last week'));
             $end_week = date('Y-m-d', strtotime('sunday this week'));
            //new insert
            $r = $this->insert_weekly([
                'start_week_date' => $start_week,
                'end_week_date' => $end_week,
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
            $affected;
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
 }
?>