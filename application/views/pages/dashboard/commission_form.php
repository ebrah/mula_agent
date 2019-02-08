
<h4 class="text-center">Add Agent commission.</h4>
<div class="row justify-content-center">
  <div class="col-sm-12 col-md-6 "> 
  <form action="<?php echo base_url()?>admin/add_commission" method="POST">
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="date" class="form-control form-control-sm" id="date" aria-describedby="date">
    </div>
    <div class="form-group">
        <label for="agentcode">Agent Code</label>
        <input type="number" name="agentcode" class="form-control form-control-sm" id="agentcode" aria-describedby="agentcode" placeholder="Agent Code">
    </div>
    <div class="form-group">
        <label for="startimes">Startimes</label>
        <input type="number" name="startimes" class="form-control form-control-sm" id="startimes">
    </div>
    <div class="form-group">
        <label for="azamtv">AzamTv</label>
        <input type="number" name="azamtv" class="form-control form-control-sm" id="azamtv">
    </div>
    <div class="form-group">
        <label for="dstv">Dstv</label>
        <input type="number" name="dstv" class="form-control form-control-sm" id="dstv">
    </div>
    <div class="form-group">
        <label for="halotel">Halotel</label>
        <input type="number" name="halotel" class="form-control form-control-sm" id="halotel">
    </div>
    <div class="form-group">
        <label for="ttcl">TTCL</label>
        <input type="number" name="ttcl" class="form-control form-control-sm" id="ttcl">
    </div>
    <div class="form-group">
        <label for="commission">Commission</label>
        <input type="number" name="commission" class="form-control form-control-sm" id="commission" placeholder="0.0">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div><!--/ col --> 
</div><!-- /row -->