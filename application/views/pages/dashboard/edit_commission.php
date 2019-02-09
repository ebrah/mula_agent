

<h4 class="text-center">Edit commission.</h4>
<div class="row justify-content-center">
  <div class="col-sm-12 col-md-6 "> 
  <form action="<?php echo base_url()?>admin/edited_commission" method="POST">
    <?php
        // echo '<pre>';
        // print_r($comm);

       foreach($comm as $value){ ?>

        <input type="number" name="id" value="<?php echo $value->id; ?>" hidden /> 
        <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="prv_date" value="<?php echo $value->date; ?>" hidden>
                <input type="date" name="date" value="<?php echo $value->date; ?>" class="form-control form-control-sm" id="date" aria-describedby="date">
            </div>
            <div class="form-group">
                <label for="agentcode">Agent Code</label>
                 <input type="number" name='prv_agentcode' value="<?php echo $value->agentcode; ?>" hidden >
                <input type="number" name="agentcode" value="<?php echo $value->agentcode; ?>" class="form-control form-control-sm" id="agentcode" aria-describedby="agentcode" placeholder="Agent Code">
            </div>
            <div class="form-group">
                <label for="startimes">Startimes</label>
                <input type="number" name="startimes" value="<?php echo $value->startimes; ?>" class="form-control form-control-sm" id="startimes">
            </div>
            <div class="form-group">
                <label for="azamtv">AzamTv</label>
                <input type="number" name="azamtv" value="<?php echo $value->azamtv; ?>" class="form-control form-control-sm" id="azamtv">
            </div>
            <div class="form-group">
                <label for="dstv">Dstv</label>
                <input type="number" name="dstv" value="<?php echo $value->dstv; ?>" class="form-control form-control-sm" id="dstv">
            </div>
            <div class="form-group">
                <label for="halotel">Halotel</label>
                <input type="number" name="halotel" value="<?php echo $value->halotel; ?>" class="form-control form-control-sm" id="halotel">
            </div>
            <div class="form-group">
                <label for="ttcl">TTCL</label>
                <input type="number" name="ttcl" value="<?php echo $value->ttcl; ?>" class="form-control form-control-sm" id="ttcl">
            </div>
            <div class="form-group">
                <label for="commission">Commission</label>
                <input type="number" name="prv_commission" value="<?php echo $value->total_commission; ?>" hidden>
                <input type="number" name="commission" value="<?php echo $value->total_commission; ?>" class="form-control form-control-sm" id="commission" placeholder="0.0">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
         </form>

       <?php } ;?>

</div><!--/ col --> 
</div><!-- /row -->