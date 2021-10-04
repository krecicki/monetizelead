<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra"> 
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_62") ?></li>
</ol>

<p><?php echo lang("ctn_63") ?></p>

<hr>

<table class="table table-bordered tbl">
<tr class='table-header'><td><?php echo lang("ctn_11") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
<?php foreach($email_templates->result() as $r) : ?>
	<tr><td><?php echo $r->title ?></td><td><a href="<?php echo site_url("admin/edit_email_template/" . $r->ID) ?>" class="btn btn-warning btn-xs" title="<?php echo lang("ctn_55") ?>"><span class="glyphicon glyphicon-cog"></span></a></td></tr>
<?php endforeach; ?>
</table>
</div>