<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Mula Admin</a>
 <?php if($this->session->flashdata('SUCCESS')){?>
    <div class="alert alert-success form-control  w-100" role="alert">
         <?php echo $this->session->flashdata('SUCCESS'); ?>
    </div>
  <?php
   }
  ?>
 
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</nav>