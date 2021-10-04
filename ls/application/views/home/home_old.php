<div class="white-area-content">

<div class="row">

<div class="col-md-3">
<div class="dashboard-window clearfix" style="background: #62acec; border-left: 5px solid #5798d1;">
	<div class="d-w-icon">
		<span class="glyphicon glyphicon-send giant-white-icon"></span>
	</div>
	<div class="d-w-text">
		 <span class="d-w-num"><?php echo number_format($stats->total_members) ?></span><br /><?php echo lang("ctn_136") ?>
	</div>
</div>
</div>

<div class="col-md-3">
<div class="dashboard-window clearfix" style="background: #5cb85c; border-left: 5px solid #4f9f4f;">
	<div class="d-w-icon">
		<span class="glyphicon glyphicon-wrench giant-white-icon"></span>
	</div>
	<div class="d-w-text">
		 <span class="d-w-num"><?php echo number_format($stats->new_members) ?></span><br /><?php echo lang("ctn_137") ?>
	</div>
</div>
</div>

<div class="col-md-3">
<div class="dashboard-window clearfix" style="background: #f0ad4e; border-left: 5px solid #d89b45;">
	<div class="d-w-icon">
		<span class="glyphicon glyphicon-folder-close giant-white-icon"></span>
	</div>
	<div class="d-w-text">
		 <span class="d-w-num"><?php echo number_format($stats->active_today) ?></span><br /><?php echo lang("ctn_138") ?>
	</div>
</div>
</div>

<div class="col-md-3">
<div class="dashboard-window clearfix" style="background: #d9534f; border-left: 5px solid #b94643;">
	<div class="d-w-icon">
		<span class="glyphicon glyphicon-user giant-white-icon"></span>
	</div>
	<div class="d-w-text">
		 <span class="d-w-num"><?php echo number_format($online_count) ?></span><br /><?php echo lang("ctn_139") ?>
	</div>
</div>
</div>

</div>

<hr>


<div class="row">
<div class="col-md-8">
<div class="block-area align-center">
<h4 class="home-label"><?php echo lang("ctn_140") ?></h4>
<canvas id="myChart" class="graph-height"></canvas>
</div>

<div class="block-area">
<?php echo lang("ctn_326") ?> <b><?php echo date($this->settings->info->date_format, $this->user->info->online_timestamp); ?></b>
</div>

</div>
<div class="col-md-4">

<div class="block-area">
<h4 class="home-label"><?php echo lang("ctn_141") ?></h4>
<?php foreach($new_members->result() as $r) : ?>
	<div class="new-user">
	<?php
		if($r->joined + (3600*24) > time()) {
			$joined = lang("ctn_144");
		} else {
			$joined = date($this->settings->info->date_format, $r->joined);
		}

		if($r->oauth_provider == "twitter") {
			$ava = "images/social/twitter.png";
		} elseif($r->oauth_provider == "facebook") {
			$ava = "images/social/facebook.png";
		} elseif($r->oauth_provider == "google") {
			$ava = "images/social/google.png";
		} else {
			$ava = $this->settings->info->upload_path_relative . "/default.png";
		}

	?>
<img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->avatar ?>" class="new-member-avatar user_icon" /> <a href="<?php echo site_url("profile/" . $r->username) ?>"><?php echo $r->username ?></a> <div class="new-member-joined"><?php echo $joined ?></div>
</div>
<?php endforeach; ?>

</div>

<div class="block-area align-center" id="membersTypeChatArea">
<h4 class="home-label"><?php echo lang("ctn_145") ?></h4>
<canvas id="memberTypesChart"></canvas>
</div>

</div>
</div>

</div>