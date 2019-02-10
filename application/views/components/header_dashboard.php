<?php
 

    if(!$this->session->has_userdata('user_id') && !$this->session->has_userdata('email')){
        redirect(base_url().'agent');
    }

    if($this->session->userdata('active') != 1 ){
        $this->session->set_flashdata('FAIL', 'Your account is locked you can\'t access.');
        redirect(base_url().'agent');
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
    