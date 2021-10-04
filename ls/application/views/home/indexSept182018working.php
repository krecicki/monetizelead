<div class="white-area-content">

<?php if($this->user->info->admin):?>
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

<div class="row" style="margin-top:20px;">

<div class="col-md-3">
<div class="dashboard-window clearfix" style="background: #62acec; border-left: 5px solid #5798d1;">
	<div class="d-w-icon">
		<span class="glyphicon glyphicon-send giant-white-icon"></span>
	</div>
	<div class="d-w-text">
		 <span class="d-w-num"><?php echo number_format($leads_generated_today) ?></span><br />Leads Today
	</div>
</div>
</div>

<div class="col-md-3">
<div class="dashboard-window clearfix" style="background: #5cb85c; border-left: 5px solid #4f9f4f;">
	<div class="d-w-icon">
		<span class="glyphicon glyphicon-wrench giant-white-icon"></span>
	</div>
	<div class="d-w-text">
		 <span class="d-w-num"><?php echo number_format($leads_generated_all) ?></span><br />All Leads
	</div>
</div>
</div>

<div class="col-md-3">
<div class="dashboard-window clearfix" style="background: #f0ad4e; border-left: 5px solid #d89b45;">
	<div class="d-w-icon">
		<span class="glyphicon glyphicon-folder-close giant-white-icon"></span>
	</div>
	<div class="d-w-text">
		 <span class="d-w-num">$<?php echo number_format($leads_spent_today) ?></span><br />Revenue Today
	</div>
</div>
</div>

<div class="col-md-3">
<div class="dashboard-window clearfix" style="background: #d9534f; border-left: 5px solid #b94643;">
	<div class="d-w-icon">
		<span class="glyphicon glyphicon-user giant-white-icon"></span>
	</div>
	<div class="d-w-text">
		 <span class="d-w-num">$<?php echo number_format($leads_spent_all_time) ?></span><br />All Time Revenue
	</div>
</div>
</div>

</div>
<?php else:?>
<div class="row">

<div class="col-md-3">
<div class="dashboard-window clearfix" style="background: #62acec; border-left: 5px solid #5798d1;">
	<div class="d-w-icon">
		<span class="glyphicon glyphicon-send giant-white-icon"></span>
	</div>
	<div class="d-w-text">
		 <span class="d-w-num"><?php echo number_format($all_purchases) ?></span><br />All Purchases
	</div>
</div>
</div>

<div class="col-md-3">
<div class="dashboard-window clearfix" style="background: #5cb85c; border-left: 5px solid #4f9f4f;">
	<div class="d-w-icon">
		<span class="glyphicon glyphicon-wrench giant-white-icon"></span>
	</div>
	<div class="d-w-text">
		 <span class="d-w-num"><?php echo number_format($leads_purchased_today) ?></span><br />Today
	</div>
</div>
</div>

<div class="col-md-3">
<div class="dashboard-window clearfix" style="background: #f0ad4e; border-left: 5px solid #d89b45;">
	<div class="d-w-icon">
		<span class="glyphicon glyphicon-folder-close giant-white-icon"></span>
	</div>
	<div class="d-w-text">
		 <span class="d-w-num">$<?php echo number_format($amount_spent_all_time) ?></span><br />All Time Spent
	</div>
</div>
</div>

<div class="col-md-3">
<div class="dashboard-window clearfix" style="background: #d9534f; border-left: 5px solid #b94643;">
	<div class="d-w-icon">
		<span class="glyphicon glyphicon-user giant-white-icon"></span>
	</div>
	<div class="d-w-text">
		 <span class="d-w-num">$<?php echo number_format($amount_spent_today) ?></span><br />Spent Today
	</div>
</div>
</div>

</div>
<?php endif;?>
<hr>


<div class="row">
<div class="col-md-<?php echo ($this->user->info->admin? '8': '12')?>" >
<div class="block-area align-center">
<h4 class="home-label">Historical Lead Purchases</h4>
<canvas id="myChart" class="graph-height"></canvas>
</div>


</div>
<div class="col-md-4 <?php echo($this->user->info->admin?'':'hidden')?>">

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
<div class="row">
<hr>
<div class="col-md-12">
<h4 class="home-label">Leads Purcahsed</h1>
<table id="leads-table" class="table table-bordered">
<thead>
<tr class="table-header">
<td>Id</td>
<td>Name</td>
<td>Email</td>
<td>Phone</td>
<td>Token</td>
<td>Purchase Date</td>
</tr>
</thead>
<tbody>
<?php foreach($leads->result() as $r) : ?>

<tr>
<td><?php echo $r->id ?></td>
<td><?php echo $r->name?></td>
<td><?php echo $r->email?></td>
<td><?php echo $r->phone?></td>
<td><?php echo $r->token ?></td>
<td><?php echo $r->purchased_date ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="block-area">
<?php echo lang("ctn_326") ?> <b><?php echo date($this->settings->info->date_format, $this->user->info->online_timestamp); ?></b>
</div>
</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
   var table = $('#leads-table').DataTable({"filter":false,"length":false});
   $('#leads-table_length').addClass('hidden');
});	

</script>