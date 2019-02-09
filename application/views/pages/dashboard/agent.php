
 <h4>Agent commission.</h4>
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
              <th>weekly commission</th>

            </tr>
          </thead>
          <tbody>

          <?php
             foreach ($commission as $comm) {?>
             <tr>
              <td> <?php echo $comm->date;?></td>
              <td> <b> <?php echo $comm->agentcode;?> </b> </td>
              <td> <?php echo $comm->startimes;?> </td>
              <td> <?php echo $comm->azamtv;?> </td>
              <td> <?php echo $comm->dstv;?> </td>
              <td> <?php echo $comm->halotel;?> </td>
              <td> <?php echo $comm->ttcl;?> </td>
              <td> <?php echo $comm->total_commission;?> </td>
              <td> <?php echo $comm->weekly_commission;?> </td>

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