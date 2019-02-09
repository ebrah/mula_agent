<div class="container py-lg-5">
  <div class="row justify-content-center">
      <div class="col-sm-12 col-md-5">
        <h3 class="my-5 text-center">
           Mula <small class="text-muted"> Agent registration.</small>
        </h3> 
        <!-- <p class="text-right">
           <a href="<?php echo base_url();?>agent/login" class="">Agent</a>
        </p> -->
        
        <form action="<?php echo base_url();?>admin/ad_register/agent" method="POST">
         <?php
             if($this->session->flashdata('SUCCESS')){?>
              <small class="form-text text-success"> <?php echo $this->session->flashdata('SUCCESS');?> </small>  
            <?php
             }else{?>
              <small class="form-text text-danger"> <?php echo $this->session->flashdata('FAIL');?> </small>  
             <?php 
             }
          ?>
            <div class="form-group">
              <label for="agentcode">Agent Code</label>
              <input type="number" name="agentcode" class="form-control" id="agentcode"  placeholder="Enter agent code" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
            </div>
            <div class="d-flex justify-content-between">
            
              <a href="<?php echo base_url();?>agent" class="btn btn-lg btn-primary">cancel</a>
              <button type="submit" class="btn btn-lg btn-primary">Submit</button>
            </div><!-- /d-flex --->

        </form>
      </div><!-- /col -->

  </div><!-- /row -->

</div>
