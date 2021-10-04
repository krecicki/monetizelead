<div class="white-area-content">
<style>
#leads-table_length,#reversals-table_length{display:none;}
</style>
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-usd"></span>Lead Types</div>
	<div class="db-header-extra form-inline">	
		<input type="button" class="btn btn-primary btn-sm" id="manage-lead-type" value="Add New Lead Type" data-toggle="modal" data-target="#leadTypeModal" />		
	</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>">Home</a></li>
  <li class="active">Lead Types</li>
</ol>

<?php echo form_open(site_url("leads/delete_type"), array("class" => "form-horizontal")) ?>
    <input type="hidden" id="lead_type_id" name="lead_type_id"/>	
	<input type="submit" name="sdelete" style="opacity:0;width:0px;height:0px;" value="Delete Lead Type" class="btn btn-primary form-control" />
<?php echo form_close() ?>	
<div class="panel panel-default">
	<div class="panel-header">
		<h4 class="home-label">Lead Types</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">				
				<table id="leads-table" class="table table-bordered">
					<thead>
						<tr class="table-header">
							<td>Id</td>
							<td>Lead Type</td>
							<td>Cost</td>
							<td>&nbsp;</td>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>	
	</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('#lead_type').keydown(function(e){
		
		if(e.which == 32 || e.keyCode == 32)
			return false;
	});
	
	 var table = $('#leads-table').DataTable({
        "dom" : "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "processing": false,
        "pagingType" : "full_numbers",
        "pageLength" : 10,
        "serverSide": true,
        "orderMulti": false,
        "order": [
          [1, "asc" ]
        ],
        "columns": [
        null,
        null,
        null,
		{ "orderable" : false }
		],
        "ajax": {
            url : "<?php echo site_url("leads/lead_types") ?>",
            type : 'GET'
        },
        "drawCallback": function(settings, json) {
        $('[data-toggle="tooltip"]').tooltip();
      }
    });
  
	
    $('.type-edit').click(function(){
	
	   var id = $(this).attr('id');	   
	   var row = $(this).parent().parent();
	   var type = row.find('td:eq(1)').text();
	   var cost = row.find('td:eq(2)').text();
	   $('#id').val(id);
	   $('#lead_type').val(type);
	   $('#cost').val(cost);
	   $('#leadTypeModal').modal('show');
	   //$('#manage-lead-type').click();
   });       
});	

function onEdit(id, type, cost){
	debugger;
    $('#id').val(id);
	$('#lead_type').val(type);
	$('#cost').val(cost);
	$('#leadTypeModal').modal('show');
    return false;
}

</script>
<div class="modal fade" id="leadTypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Add/Manage Lead Type</h4>
		  </div>
		  <div class="modal-body">
			<?php echo form_open(site_url("leads/submit_type"), array("class" => "form-horizontal")) ?>
				<input type="hidden" id="id" value="-1" name="id"/>	
				<div class="form-group">
					<label for="lead_type" class="col-sm-4 control-label">Lead Type</label>			    
					<input type="text" id="lead_type" class="col-sm-6" name="lead_type"/>
				</div>	
				<div class="form-group">
					<label for="cost" class="col-sm-4 control-label">Cost</label>			    
					<input type="number" id="cost" class="col-sm-2" name="cost"/>
				</div>
				<div class="form-group">
					<div class="col-sm-4"></div>
					<div class="col-sm-6">
						<input type="submit" name="s" value="Save Lead Type" class="btn btn-primary form-control" />
					</div>
				</div>	
			<?php echo form_close() ?>	
		  </div>
		</div>  
	</div>
</div>
