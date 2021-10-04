<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo $user->username ?></div>
    <div class="db-header-extra"> 
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li class="active"> <?php echo lang("ctn_199") ?> <?php echo $user->username ?></li>
</ol>

<hr>


<div class="profile-area clearfix">
	<div class="profile-sidebar">
		<table class="table">
		<tr>
		<td>
		<img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $user->avatar ?>">
		</td>
		<td valign="top">
		<h4><?php echo $user->username ?></h4><p class="user_level_display"><?php echo $this->common->get_user_role($user) ?></p>
		</td>
		</tr>
		</table>

		<hr> 
		<div class="profile-info">
		<table class="table table-bordered small-text">
		<tr><td><?php echo lang("ctn_201") ?> <span class="profile-info-content"><?php echo $user->first_name ?> <?php echo $user->last_name ?></span></td></tr>
		<tr><td><?php echo lang("ctn_202") ?> <span class="profile-info-content"><?php echo date($this->settings->info->date_format, $user->joined) ?></span></td></tr>
		<tr><td><?php echo lang("ctn_203") ?> <span class="profile-info-content"><?php echo date($this->settings->info->date_format, $user->online_timestamp) ?></span></td></tr>
		<?php foreach($fields->result() as $r) : ?>
			<?php if($r->type == 1) : ?>
				<tr><td><?php echo $r->name ?><br /><strong><?php echo $r->value ?></strong></td></tr>
			<?php else : ?>
				<tr><td><?php echo $r->name ?> <span class="profile-info-content"><?php echo $r->value ?></span></td></tr>
			<?php endif; ?>
		<?php endforeach; ?>
		</table>
		</div>
		<div class="profile-info-p2">
		<h5><?php echo lang("ctn_204") ?></h5>
		<?php if($groups->num_rows() > 0) : ?>
			<?php foreach($groups->result() as $r) : ?>
				<label class="label label-default"><?php echo $r->name ?></label>
			<?php endforeach; ?>
		<?php endif; ?>
		</div>
	</div>
	<div class="profile-main">
		<div class="profile-main-content">
		<h4 class="home-label"><?php echo lang("ctn_205") ?></h4>
		<?php if(empty($user->aboutme)) : ?>
			<p>Welcome to my profile!</p>
		<?php else : ?>
			<p><?php echo nl2br($user->aboutme) ?></p>
		<?php endif; ?>
		</div>
	</div>
</div>
</div>