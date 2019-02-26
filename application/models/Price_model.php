<?php
 class Price_model extends Crud_model{
    protected $_table = 'prices';
    protected $_primary_key = 'id';

    public function __constructor(){
        parent::__constructor();
    }
}
?>