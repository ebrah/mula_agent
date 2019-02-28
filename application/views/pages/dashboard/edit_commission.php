
<div class="row justify-content-center">
  <div class="col-sm-12 col-md-6 "> 
<fieldset>
  <legend><h4 class="form-title">Price for each Media.</h4></legend>
  <form action="<?php echo base_url()?>admin/change_price" method="POST">
      <div class="price-perEach">
    <?php  
      foreach ($prices as $price):
         $starPrice = $price->startimes;
         $azamPrice = $price->azamtv;
         $dstvPrice = $price->dstv;
         $halotelPrice = $price->halotel;
         $ttclPrice = $price->ttcl;
      ?>
          
        <div class="form-group">
                <label for="starPrice"> Startimes </label>
                <input type="number" name="startimesPrice" value="<?php echo $price->startimes; ?>" class="form-control form-control-sm" id="startimesPrice"/>
                <input type="number" name="id" value="<?php echo $price->id; ?>" hidden/>
            </div>
            <div class="form-group">
                <label for="azamPrice"> AzamTv </label>
                <input type="number" name="azamtvPrice" value="<?php echo $price->azamtv; ?>" class="form-control form-control-sm" id="azamtvPrice"/>
            </div>
            <div class="form-group">
                <label for="dstvPrice"> Dstv </label>
                <input type="number" name="dstvPrice" value="<?php echo $price->dstv; ?>" class="form-control form-control-sm" id="dstvPrice"/>
            </div>
            <div class="form-group">
                <label for="halotelPrice"> Halotel </label>
                <input type="number" name="halotelPrice" value="<?php echo $price->halotel; ?>" class="form-control form-control-sm" id="halotelPrice"/>
            </div>
            <div class="form-group">
                <label for="ttclPrice"> TTCL </label>
                <input type="number" name="ttclPrice" value="<?php echo $price->ttcl; ?>" class="form-control form-control-sm" id="ttclPrice"/>
            </div>
            
      <?php endforeach;
      
      ?>

        <button type="submit" class="btn btn-success btn-sm">Change Price</button>
      </div><!--/price-perEach-->
    </form><!--/ form -->
</fieldset>

<fieldset>
  <legend> <h4 class="form-title">Edit commission.</h4> </legend>
  <form action="<?php echo base_url()?>admin/edited_commission" method="POST">
  <?php
    foreach($comm as $value): ?>
     <input type="number" name="id" value="<?php echo $value->id; ?>" hidden /> 
       <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="prv_date" value="<?php echo $value->date; ?>" hidden>
            <input type="date" name="date" value="<?php echo $value->date; ?>"  class="form-control form-control-sm" id="date" aria-describedby="date"/>
        </div>
        <div class="form-group">
            <label for="agentcode">Agent Code</label>
            <input type="number" name='prv_agentcode' value="<?php echo $value->agentcode; ?>" hidden >
            <input type="number" name="agentcode"  value="<?php echo $value->agentcode; ?>" class="form-control form-control-sm" id="agentcode" aria-describedby="agentcode" placeholder="Agent Code"/>
        </div>
        <div class="form-group">
            <label for="startimes">Startimes</label>
            <input type="number" name="startimes" value="<?php echo $value->startimes; ?>" calculated="<?php echo $value->startimes * $starPrice; ?>" class="calculate form-control form-control-sm" id="startimes"/>
        </div>
        <div class="form-group">
            <label for="azamtv">AzamTv</label>
            <input type="number" name="azamtv" value="<?php echo $value->azamtv; ?>" calculated="<?php echo $value->azamtv * $azamPrice; ?>" class="calculate form-control form-control-sm" id="azamtv"/>
        </div>
        <div class="form-group">
            <label for="dstv">Dstv</label>
            <input type="number" name="dstv" value="<?php echo $value->dstv; ?>" calculated="<?php echo $value->dstv * $dstvPrice; ?>" class="calculate form-control form-control-sm" id="dstv"/>
        </div>
        <div class="form-group">
            <label for="halotel">Halotel</label>
            <input type="number" name="halotel" value="<?php echo $value->halotel; ?>" calculated="<?php echo $value->halotel * $halotelPrice; ?>" class="calculate form-control form-control-sm" id="halotel"/>
        </div>
        <div class="form-group">
            <label for="ttcl">TTCL</label>
            <input type="number" name="ttcl" value="<?php echo $value->ttcl; ?>" calculated="<?php echo $value->ttcl * $ttclPrice; ?>" class="calculate form-control form-control-sm" id="ttcl"/>
        </div>
        <div class="form-group">
            <label for="commission">Commission</label>
            <input type="number" name="prv_commission" value="<?php echo $value->total_commission; ?>" hidden>
            <input type="number" name="commission" value="<?php echo $value->total_commission; ?>" class="form-control form-control-sm" id="commission" placeholder="0.0" disabled/>
            <input type="number" name="commission" value="<?php echo $value->total_commission; ?>" id="commission2" hidden/>
        </div>
       <?php endforeach;?>
        <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</fieldset>

</div><!--/ col --> 
</div><!-- /row -->