<?php
    $current = $this->uri->segment(2);

    $page = $this->session->userdata('agent');
?>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <?php if($page == 1){?>
            <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
        <?php }else{?>
          <li class="nav-item">
            <a class="nav-link <?php echo ($current == 'dashboard')? 'active' : '' ; ?>" href="<?php echo base_url()?>admin/dashboard">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($current == 'commission_form')? 'active' : '' ; ?> " href="<?php echo base_url()?>admin/commission_form">
              <span data-feather="file"></span>
              Add commission
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link <?php echo ($current == 'get_agents')? 'active' : '' ; ?>" href="<?php echo base_url();?>agent/get_agents">
              <span data-feather="shopping-cart"></span>
               Agents
            </a>
          </li>
        <?php } ?>
    
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      
      </div>