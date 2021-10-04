<div class="container">
    <div class="row">
    <div class="col-md-5 center-block-e">

<div class="login-page-header">
  <?php echo lang("ctn_304") ?> <?php echo $this->settings->info->site_name ?>

</div>

<div class="login-page">
        <?php if(isset($_GET['redirect'])) : ?>
				<?php echo form_open(site_url("login/pro/" . urlencode($_GET['redirect']))) ?>
        <?php else : ?>
        <?php echo form_open(site_url("login/pro")) ?>
        <?php endif; ?>
    			<div class="input-group">
      				<span class="input-group-addon white-form-bg"><span class="glyphicon glyphicon-user"></span></span>
      				<input type="text" name="email" class="form-control" placeholder="<?php echo lang("ctn_303") ?>">
    			</div><br />

    			<div class="input-group">
      				<span class="input-group-addon white-form-bg"><span class="glyphicon glyphicon-lock"></span></span>
      				<input type="password" name="pass" class="form-control" placeholder="<?php echo lang("ctn_180") ?>">
    			</div>
          <p class="decent-margin"><input type="submit" class="btn btn-primary form-control" value="<?php echo lang("ctn_184") ?>"></p>
          <p class="decent-margin"><a href="<?php echo site_url("login/forgotpw") ?>"><?php echo lang("ctn_181") ?></a></p>

          <?php if(!$this->settings->info->disable_social_login) : ?>
<div class="text-center decent-margin-top">
<div class="btn-group">
  <a href="<?php echo site_url("login/twitter_login") ?>" class="btn btn-default" >
    <img src="<?php echo base_url() ?>images/social/twitter.png" height="20" class='social-icon' />
   Twitter</a>
</div>

<div class="btn-group">
  <a href="<?php echo site_url("login/facebook_login") ?>" class="btn btn-default" >
    <img src="<?php echo base_url() ?>images/social/facebook.png" height="20" class='social-icon' />
   Facebook</a>
</div>

<div class="btn-group">
  <a href="<?php echo site_url("login/google_login") ?>" class="btn btn-default" >
    <img src="<?php echo base_url() ?>images/social/google.png" height="20" class='social-icon' />
   Google</a>
</div>
</div>
<?php endif; ?>
          <hr> 
          <p class="decent-margin"><a href="<?php echo site_url("register") ?>" class="btn btn-success form-control" ><?php echo lang("ctn_305") ?></a></p>
    			<?php echo form_close() ?>

</div>

</div>
</div>
</div>