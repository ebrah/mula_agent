
      <h4>Agents </h4>
      <div class="table-responsive">
       <?php 
       if(!empty($agents)){
         
          print_r(empty($agents));
          print_r($agents);
         ?>

        <table class="table table-striped table-sm">
          <thead>
            <tr>
              
              <th>Agent code</th>
              <th>Email</th>
              <th>Active</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

          <?php
             foreach ($agents as $agent) {
                 if($agent->code){ ?>
             <tr>
              <td> <?php echo $agent->code;?></td>
              <td> <?php echo $agent->email;?> </td>
              <td> <?php if ($agent->active == 1){
                     echo '<span class ="badge badge-success"> active </span>';    
                }else{
                      echo '<span class ="badge badge-danger"> not active </span>';    
                }?> 
              </td>
              <td> 

              <?php if($agent->active != 1){ ?>  
                <a href="<?php echo base_url()?>agent/activate/<?php echo $agent->id;?>"  class="badge badge-success">Activate</a>
              <?php }else{ ?>
                <a href="<?php echo base_url()?>agent/deactivate/<?php echo $agent->id;?>"  class="badge badge-danger">Deactivate</a>
             <?php }  
              ?> 

            <a href="<?php echo base_url()?>agent/delete/code/<?php echo $agent->code;?>/id/<?php echo $agent->id;?>"  class="badge badge-danger">Delete agent</a>
              
            </td>
             </tr> 

               <?php  }
              ?>
          
          <?php 
             }
          ?>         
          </tbody>
        </table>

        <?php
           }else{
              echo '<pre>';
              echo 'No any agent registered yet.';
           }
        ?>
        
      </div>
  

