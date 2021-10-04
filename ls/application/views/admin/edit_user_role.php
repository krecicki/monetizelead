<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra">
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_1") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li><a href="<?php echo site_url("admin/user_roles") ?>"><?php echo lang("ctn_316") ?></a></li>
  <li class="active"><?php echo lang("ctn_321") ?></li>
</ol>


<hr>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open(site_url("admin/edit_user_role_pro/" . $role->ID), array("class" => "form-horizontal")) ?>

<div class="form-group">
        <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_320") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="email-in" name="name" value="<?php echo $role->name ?>">
        </div>
</div>
<hr>
            <h4><?php echo lang("ctn_307") ?></h4>
            <div class="form-group">
                        <label for="username-in" class="col-md-4 label-heading"><?php echo lang("ctn_308") ?> <span class="glyphicon glyphicon-question-sign" title="<?php echo lang("ctn_312") ?>"></span></label>
                        <div class="col-md-8">
                            <input type="checkbox" name="admin" value="1" <?php if($role->admin) echo "checked" ?>>
                        </div>
            </div>
            <div class="form-group">
                        <label for="username-in" class="col-md-4 label-heading"><?php echo lang("ctn_309") ?> <span class="glyphicon glyphicon-question-sign" title="<?php echo lang("ctn_313") ?>"></span></label>
                        <div class="col-md-8">
                            <input type="checkbox" name="admin_settings" value="1" <?php if($role->admin_settings) echo "checked" ?>>
                        </div>
            </div>
            <div class="form-group">
                        <label for="username-in" class="col-md-4 label-heading"><?php echo lang("ctn_310") ?> <span class="glyphicon glyphicon-question-sign" title="<?php echo lang("ctn_314") ?>"></span></label>
                        <div class="col-md-8">
                            <input type="checkbox" name="admin_members" value="1" <?php if($role->admin_members) echo "checked" ?>>
                        </div>
            </div>
            <div class="form-group">
                        <label for="username-in" class="col-md-4 label-heading"><?php echo lang("ctn_311") ?> <span class="glyphicon glyphicon-question-sign" title="<?php echo lang("ctn_315") ?>"></span></label>
                        <div class="col-md-8">
                            <input type="checkbox" name="admin_payment" value="1" <?php if($role->admin_payment) echo "checked" ?>>
                        </div>
            </div>
            <div class="form-group">
                        <label for="username-in" class="col-md-4 label-heading"><?php echo lang("ctn_33") ?> <span class="glyphicon glyphicon-question-sign" title="<?php echo lang("ctn_343") ?>"></span></label>
                        <div class="col-md-8">
                            <input type="checkbox" name="banned" value="1" <?php if($role->banned) echo "checked" ?>>
                        </div>
            </div>
            <hr>

<input type="submit" class="form-control btn btn-primary" value="<?php echo lang("ctn_13") ?>" />
<?php echo form_close() ?>
</div>
</div>
</div>