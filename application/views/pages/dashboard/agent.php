
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
             foreach ($commission as $comm) {

               $count = 0;
                
              foreach ($comm['weekly'] as $day): ?>

                  <tr>
                  <td> <?php echo $day->date; ?></td>
                  <td> <b> <?php echo $day->agentcode?> </b> </td>
                  <td> <?php echo $day->startimes;?> </td>
                  <td> <?php echo $day->azamtv;?> </td>
                  <td> <?php echo $day->dstv;?> </td>
                  <td> <?php echo $day->halotel;?> </td>
                  <td> <?php echo $day->ttcl;?> </td>
                  <td> <?php echo $day->total_commission;   $count += 1; ?> </td>
                  
             <?php endforeach; ?>
              <td rowspan="<?php echo $count; ?>"> <?php echo $comm['week_commission']; ?> </td>
              
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