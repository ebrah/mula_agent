<?php
 class User extends Crud_model{
     protected $_table = 'user';
     protected $_primary_key = 'id';

     public function __constructor(){
         parent::__constructor();
     }
 }
?>