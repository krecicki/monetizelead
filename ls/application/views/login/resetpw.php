<div class="container">
    <div class="row">
    <div class="col-md-5 center-block-e">

<div class="login-page-header">
  <?php echo lang("ctn_185") ?>
</div>
<div class="login-page">
    <p><?php echo lang("ctn_186") ?></p>
<?php echo form_open(site_url("login/resetpw_pro/" . $token . "/" . $userid)) ?>
	  	<div class="form-group">
		  	<div class="row">
				<div class="col-md-12">
			    	<label for="password-in"><?php echo lang("ctn_187") ?></label>
			    	<input type="password" class="form-control" id="password-in" name="npassword" />
			    </div>
			</div>
	  	</div>
	  	<div class="form-group">
		  	<div class="row">
				<div class="col-md-12">
			    	<label for="password-in"><?php echo lang("ctn_188") ?></label>
			    	<input type="password" class="form-control" id="password-in" name="npassword2" />
			    </div>
			</div>
	  	</div>

	  	<input type="submit" class="btn btn-primary" name="s" value="<?php echo lang("ctn_185") ?>">
<?php echo form_close() ?>

</div>
</div>
</div>
</div>