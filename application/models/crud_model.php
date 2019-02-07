
<?php 

   class CRUD_model extends CI_Model{

     protected $_table = null;
     protected $_primary_key = null;

     public function __constructor(){
         parent::__constructor();
     }

     //get data
     public function get($id = null, $order_by = null){

           if( is_array($id)){            
             foreach ($id as $key => $value) {
                $this->db->where($key, $value);
             }
           }

           if( is_numeric($id)){
             $this->db->where($this->_primary_key, $id);
           }

           $result = $this->db->get($this->_table);
           return $result->result();

     }

     //insert data
     public function insert($data){
         $this->db->insert($this->_table, $data);
         return $this->db->insert_id();
     }

     //delete data
     public function delete($id){
         if(is_numeric($id)){
            $this->db->where($this->_primary_key, $id);
         }elseif(is_array($id)){
           foreach ($id as $key => $value) {
               $this->db->where($key, $value);
           }
         }else{
            die('You must pass a parameter to delete an item.');
         }

          $this->db->delete($this->_table);
          return $this->db->affected_rows();

     }

     //update data
     public function update($data, $where){
         
         if(is_numeric($where)){
            $this->db->where($this->_primary_key, $where);
         }elseif(is_array($where)){
           foreach ($where as $key => $value) {
               $this->db->where($key, $value);
           }
         }else{
             die('You must pass a second parameter to update()');
         }

         $this->db->update($this->_table, $data);
         return $this->db->affected_rows();
     }


  }


?>