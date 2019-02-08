<?php
 $base = $this->uri->slash_segment(1); 
//  echo $base;
 function check_who_log(){
    if(empty($this->session->userdata('user_id')) && empty($this->session->userdata('email'))){
        redirect(base_url().'agent');
    }
 }
 switch ($base) {
     case 'value':
         # code...
         break;
     
     default:
         # code...
         break;
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mula Agents</title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dashboard.css">
<body>
    