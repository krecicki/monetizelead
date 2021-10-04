<div class="white-area-content">
<style>
#leads-table_length,#reversals-table_length{display:none;}
</style>
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span>All Leads</div>
    <div class="db-header-extra"> 
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>">Home</a></li>
  <li class="active">All Leads</li>
</ol>
<?php echo form_open(site_url("leads/submit"), array("class" => "form-horizontal")) ?>
    <input type="hidden" id="lead_id" name="lead_id"/>
	<input type="hidden" id="is_delete" name="is_delete" value="1"/>
	<input type="submit" name="s" style="opacity:0;width:0px;height:0px;" value="Delete Lead" class="btn btn-primary form-control" />
<?php echo form_close() ?>	
<div class="panel panel-default">
  	<div class="panel-body">

<div class="row">
<hr>
<div class="col-md-12">
<h4 class="home-label">All Leads</h1>
<table id="leads-table" class="table table-bordered">
<thead>
<tr class="table-header">
<td>Id</td>
<td>Name</td>
<td>Email</td>
<td>Phone</td>
<td>Token</td>
<td>IP</td>
<td>Created Date</td>
<td>Tags</td>
<td>&nbsp;</td>
</tr>
</thead>
<tbody>
<?php $id = 0;?>
<?php foreach($all_leads->result() as $r) : ?>
<?php $id++;?>
<tr>
<td id="lead-<?php echo $id?>"><?php echo $r->id ?></td>
<td><?php echo $r->name?></td>
<td><?php echo $r->email?></td>
<td id="phone-<?php echo $id?>"><?php echo $r->phone?></td>
<td id="token-<?php echo $id?>"><?php echo $r->token ?></td>
<td id="ip-<?php echo $id?>"><?php echo $r->ip ?></td>
<td><?php echo $r->created_date ?></td>
<td><?php echo $r->lead_types ?></td>
<td><button  name="su" id="delete-<?php echo $id;?>"  class="btn btn-primary form-control btn-delete">Delete</button></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
</div>	

<div class="row">
<hr>
<div class="col-md-12">
<h4 class="home-label">Deleted Leads</h1>
<table id="deleted-leads-table" class="table table-bordered">
<thead>
<tr class="table-header">
<td>Id</td>
<td>Name</td>
<td>Email</td>
<td>Phone</td>
<td>Token</td>
<td>IP</td>
<td>Created Date</td>
<td>Tags</td>
<td>&nbsp;</td>
</tr>
</thead>
<tbody>
<?php $id = 0;?>
<?php foreach($deleted_leads->result() as $r) : ?>
<?php $id++;?>
<tr>
<td id="deleted-<?php echo $id?>"><?php echo $r->id ?></td>
<td><?php echo $r->name?></td>
<td><?php echo $r->email?></td>
<td id="phone-<?php echo $id?>"><?php echo $r->phone?></td>
<td id="token-<?php echo $id?>"><?php echo $r->token ?></td>
<td id="ip-<?php echo $id?>"><?php echo $r->ip ?></td>
<td><?php echo $r->created_date ?></td>
<td><?php echo $r->lead_types ?></td>
<td><button  name="su" id="undelete-<?php echo $id;?>"  class="btn btn-primary form-control btn-undelete">Un-Delete</button></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
</div>

</div>
</div>

</div>

<script type="text/javascript">
$(document).ready(function() {
   $('#leads-table').DataTable({"filter":false,"length":false});
   $('#deleted-leads-table').DataTable({"filter":false,"length":false});
   $('#leads-table_length,#deleted-leads-table_length').addClass('hidden');
   
    $('.btn-delete').click(function(){
	  
	   var id = $(this).attr('id').split('-').pop();
	   var leadId = $('td#lead-'+id).html();
	   $('#lead_id').val(leadId); 
	   $('#is_delete').val('1');
	   //click the submit button
	   $('input[name="s"]').click();
   });
   
   
   $('.btn-undelete').click(function(){
	  
	   var id = $(this).attr('id').split('-').pop();
	   var leadId = $('td#deleted-'+id).html();
	   $('#lead_id').val(leadId); 
	   $('#is_delete').val('0');
	   //click the submit button
	   $('input[name="s"]').click();
   });
  
});	

</script>