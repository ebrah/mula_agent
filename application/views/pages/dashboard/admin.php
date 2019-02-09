
 

      <h4>Agents commission.</h4>
      <div class="table-responsive">
       <?php 
       if(!empty($commission)){?>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Date</th>
              <th>Agent code</th>
              <th>Startimes</th>
              <th>AzamTv</th>
              <th>Dstv</th>
              <th>Halotel</th>
              <th>TTCL</th>
              <th>Commission</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

          <?php
             foreach ($commission as $comm) {?>
             <tr>
              <td> <?php echo $comm->date;?></td>
              <td> <a href="<?php echo base_url();?>agent/get_commission/<?php echo $comm->agentcode;?>"> <?php echo $comm->agentcode;?> </a> </td>
              <td> <?php echo $comm->startimes;?> </td>
              <td> <?php echo $comm->azamtv;?> </td>
              <td> <?php echo $comm->dstv;?> </td>
              <td> <?php echo $comm->halotel;?> </td>
              <td> <?php echo $comm->ttcl;?> </td>
              <td> <?php echo $comm->total_commission;?> </td>
              <td> 
              <a href="<?php echo base_url()?>admin/edit_commission/<?php echo $comm->id;?>"  class="badge badge-success">Edit</a>
              <a href="<?php echo base_url()?>admin/delete_commission/<?php echo $comm->id;?>"  class="badge badge-danger">Delete</a>
              </td>
             </tr> 
          <?php 
             }
          ?>         
          </tbody>
        </table>

        <?php
           }else{
              echo '<pre>';
              echo 'no commission available now.';
           }
        ?>
        
      </div>
  

