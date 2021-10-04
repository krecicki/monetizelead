<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra"><input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_319") ?>" data-toggle="modal" data-target="#memberModal" />
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_316") ?></li>
</ol>

<p><?php echo lang("ctn_318") ?></p>


<table class="table table-bordered">
<tr class="table-header"><td><?php echo lang("ctn_320") ?></td><td><?php echo lang("ctn_307") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
<?php foreach($roles->result() as $r) : ?>
<tr><td><?php echo $r->name ?></td>
<td>
  <?php if($r->admin) : ?><span class="user_role_button admin" title="<?php echo lang("ctn_308") ?>" data-placement="bottom" data-toggle="tooltip"><?php echo lang("ctn_308") ?></span><?php endif; ?>
  <?php if($r->admin_settings) : ?><span class="user_role_button admin" title="<?php echo lang("ctn_309") ?>" data-placement="bottom" data-toggle="tooltip"><?php echo lang("ctn_309") ?></span><?php endif; ?>
  <?php if($r->admin_members) : ?><span class="user_role_button admin" title="<?php echo lang("ctn_310") ?>" data-placement="bottom" data-toggle="tooltip"><?php echo lang("ctn_310") ?></span><?php endif; ?>
  <?php if($r->admin_payment) : ?><span class="user_role_button admin" title="<?php echo lang("ctn_311") ?>" data-placement="bottom" data-toggle="tooltip"><?php echo lang("ctn_311") ?></span><?php endif; ?>
  <?php if($r->banned) : ?><span class="user_role_button banned" title="<?php echo lang("ctn_33") ?>" data-placement="bottom" data-toggle="tooltip"><?php echo lang("ctn_33") ?></span><?php endif; ?>
</td>
<td><a href="<?php echo site_url("admin/edit_user_role/" . $r->ID) ?>" class="btn btn-warning btn-xs" title="<?php echo lang("ctn_55") ?>"><span class="glyphicon glyphicon-cog"></span></a> <a href="<?php echo site_url("admin/delete_user_role/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo lang("ctn_317") ?>')" title="<?php echo lang("ctn_57") ?>"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
<?php endforeach; ?>
</table>

<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang("ctn_319") ?></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(site_url("admin/add_user_role_pro"), array("class" => "form-horizontal")) ?>
            <div class="form-group">
                    <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_320") ?></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="email-in" name="name">
                    </div>
            </div>
            <hr>
            <h4><?php echo lang("ctn_307") ?></h4>
            <div class="form-group">
                        <label for="username-in" class="col-md-4 label-heading"><?php echo lang("ctn_308") ?> <span class="glyphicon glyphicon-question-sign" title="<?php echo lang("ctn_312") ?>"></span></label>
                        <div class="col-md-8">
                            <input type="checkbox" name="admin" value="1">
                        </div>
            </div>
            <div class="form-group">
                        <label for="username-in" class="col-md-4 label-heading"><?php echo lang("ctn_309") ?> <span class="glyphicon glyphicon-question-sign" title="<?php echo lang("ctn_313") ?>"></span></label>
                        <div class="col-md-8">
                            <input type="checkbox" name="admin_settings" value="1">
                        </div>
            </div>
            <div class="form-group">
                        <label for="username-in" class="col-md-4 label-heading"><?php echo lang("ctn_310") ?> <span class="glyphicon glyphicon-question-sign" title="<?php echo lang("ctn_314") ?>"></span></label>
                        <div class="col-md-8">
                            <input type="checkbox" name="admin_members" value="1">
                        </div>
            </div>
            <div class="form-group">
                        <label for="username-in" class="col-md-4 label-heading"><?php echo lang("ctn_311") ?> <span class="glyphicon glyphicon-question-sign" title="<?php echo lang("ctn_315") ?>"></span></label>
                        <div class="col-md-8">
                            <input type="checkbox" name="admin_payment" value="1">
                        </div>
            </div>
            <div class="form-group">
                        <label for="username-in" class="col-md-4 label-heading"><?php echo lang("ctn_33") ?> <span class="glyphicon glyphicon-question-sign" title="<?php echo lang("ctn_343") ?>"></span></label>
                        <div class="col-md-8">
                            <input type="checkbox" name="banned" value="1">
                        </div>
            </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_61") ?>" />
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
</div>