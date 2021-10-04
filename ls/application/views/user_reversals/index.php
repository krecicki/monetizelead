<div class="white-area-content">
<style>
#leads-table_length,#reversals-table_length{display:none;}
</style>
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span>Customer Reversals</div>
    <div class="db-header-extra"> 
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>">Home</a></li>
  <li class="active">Customer Reversals</li>
</ol>

<?php echo form_open(site_url("user_reversals/submit"), array("class" => "form-horizontal")) ?>
    <input type="hidden" id="lead_id" name="lead_id"/>
	<input type="hidden" id="is_reverse" name="is_reverse" value="1"/>
	<input type="submit" name="s" style="opacity:0;width:0px;height:0px;" value="Reverse Purchase" class="btn btn-primary form-control" />
<?php echo form_close() ?>
	
<div class="panel panel-default">
  	<div class="panel-body">

<div class="row">
<hr>
<div class="col-md-12">
<h4 class="home-label">Customer Reversals</h1>
<table id="reversals-table" class="table table-bordered">
<thead>
<tr class="table-header">
<td>Id</td>
<td>Name</td>
<td>Email</td>
<td>Customer Phone</td>
<td>Token</td>
<td>Purchase Date</td>
<td>&nbsp;</td>
</tr>
</thead>
<tbody>
<?php $id = 0;?>
<?php foreach($leads_reversals->result() as $r) : ?>
<?php $id++;?>
<tr>
<td id="reverse-<?php echo $id?>"><?php echo $r->id ?></td>
<td><?php echo $r->name?></td>
<td><?php echo $r->email?></td>
<td id="phone-<?php echo $id?>"><?php echo $r->phone_no?></td>
<td id="token-<?php echo $id?>"><?php echo $r->token ?></td>
<td><?php echo $r->purchased_date ?></td>
<td><button  name="su" id="unreverse-<?php echo $id;?>"  class="btn btn-primary form-control btn-unreverse">Unreverse</button></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
</div>	

<div class="row">
<hr>
<div class="col-md-12">
<h4 class="home-label">Customer Purcahses</h1>
<table id="leads-table" class="table table-bordered">
<thead>
<tr class="table-header">
<td>Id</td>
<td>Name</td>
<td>Email</td>
<td>Customer Phone</td>
<td>Token</td>
<td>Purchase Date</td>
<td>&nbsp;</td>
</tr>
</thead>
<tbody>
<?php $id = 0;?>
<?php foreach($leads->result() as $r) : ?>
<?php $id++;?>
<tr>
<td id="lead-<?php echo $id?>"><?php echo $r->id ?></td>
<td><?php echo $r->name?></td>
<td><?php echo $r->email?></td>
<td id="phone-<?php echo $id?>"><?php echo $r->phone_no?></td>
<td id="token-<?php echo $id?>"><?php echo $r->token ?></td>
<td><?php echo $r->purchased_date ?></td>
<td><button  name="s" id="reverse-<?php echo $id;?>"  class="btn btn-primary form-control btn-reverse">Reverse Purchase</button></td>
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
   var table = $('#leads-table').DataTable({"filter":false,"length":false});
   $('#leads-table_length,#reversals-table_length').addClass('hidden');
   $('#reversals-table').DataTable({"filter":false,"length":false});
   $('.btn-reverse').click(function(){
	  
	   var id = $(this).attr('id').split('-').pop();
	   var leadId = $('td#lead-'+id).html();
	   $('#lead_id').val(leadId); 
	   $('#is_reverse').val('1');
	   //click the submit button
	   $('input[name="s"]').click();
   });
   
   $('.btn-unreverse').click(function(){
	
	   var id = $(this).attr('id').split('-').pop();
	   var leadId = $('td#reverse-'+id).html();
	   $('#lead_id').val(leadId); 
	   $('#is_reverse').val('0');
	   //click the submit button
	   $('input[name="s"]').click();
   });
});	

</script>