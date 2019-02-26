

<div class="row justify-content-center">
  <div class="col-sm-12 col-md-6 "> 
<fieldset>
  <legend><h4 class="form-title">Price for each Media.</h4></legend>
  <form action="<?php echo base_url()?>admin/change_price" method="POST">
      <div class="price-perEach">
    <?php  
      foreach ($prices as $price):?>
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
  <legend> <h4 class="form-title">Add agent commission.</h4> </legend>
  <form action="<?php echo base_url()?>admin/add_commission" method="POST">
  <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control form-control-sm" id="date" aria-describedby="date"/>
        </div>
        <div class="form-group">
            <label for="agentcode">Agent Code</label>
            <input type="number" name="agentcode" class="form-control form-control-sm" id="agentcode" aria-describedby="agentcode" placeholder="Agent Code"/>
        </div>
        <div class="form-group">
            <label for="startimes">Startimes</label>
            <input type="number" name="startimes" calculated="0" class="calculate form-control form-control-sm" id="startimes"/>
        </div>
        <div class="form-group">
            <label for="azamtv">AzamTv</label>
            <input type="number" name="azamtv" calculated="0" class="calculate form-control form-control-sm" id="azamtv"/>
        </div>
        <div class="form-group">
            <label for="dstv">Dstv</label>
            <input type="number" name="dstv" calculated="0" class="calculate form-control form-control-sm" id="dstv"/>
        </div>
        <div class="form-group">
            <label for="halotel">Halotel</label>
            <input type="number" name="halotel" calculated="0" class="calculate form-control form-control-sm" id="halotel"/>
        </div>
        <div class="form-group">
            <label for="ttcl">TTCL</label>
            <input type="number" name="ttcl" calculated="0" class="calculate form-control form-control-sm" id="ttcl"/>
        </div>
        <div class="form-group">
            <label for="commission">Commission</label>
            <input type="number" name="commission" class="form-control form-control-sm" id="commission" placeholder="0.0" disabled/>
            <input type="number" name="commission" id="commission2" hidden/>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</fieldset>
</div><!--/ col --> 
</div><!-- /row -->