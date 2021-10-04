<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leads extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}	
	}

	//Get /index
	public function index() 
	{
		// Assigns the highlight to the sidebar link
		$this->template->loadData("activeLink", 
			array("leads" => array("general" => 1)));
        
		$all_leads = $this->user_model->get_all_leads();
		$deleted_leads = $this->user_model->get_all_deleted_leads();
		
		// Loads HTML page
		$this->template->loadContent("leads/index.php", array(
			"all_leads"=>$all_leads,
			"deleted_leads"=>$deleted_leads
			)
		);
	}	
	
	//Get /types
	public function types() 
	{
		// Assigns the highlight to the sidebar link
		$this->template->loadData("activeLink", 
			array("types" => array("general" => 1)));
        
		//lead_types = $this->user_model->get_admin_lead_types();
		//$deleted_leads = $this->user_model->get_all_deleted_leads();
		
		// Loads HTML page
		$this->template->loadContent("leads/types.php", array(
			
			)
		);
	}	
	
	public function lead_types() 
	{
		$this->load->library("datatables");

		$this->datatables->set_default_order("lead_types.lead_type", "desc");

		//set page ordering options that can be used
		$this->datatables->ordering(
			array(
				 0 => array(
				 	"lead_types.id" => 0
				 ),
				 1 => array(
				 	"lead_types.lead_type" => 0
				 ),
				 2 => array(
				 	"lead_types.cost" => 0
				 )
			)
		);
		
		$this->datatables->set_total_rows(
			$this->user_model
				 ->get_admin_lead_type_count()
		);
		
		$lead_types = $this->user_model->get_admin_lead_types($this->datatables);

		foreach($lead_types->result() as $r) {
			
			$this->datatables->data[] = array(
				$r->id,
				$r->lead_type,
				$r->cost,						
				'<a id="'.$r->id.'" href="#" onclick="return onEdit('.$r->id.',\''.$r->lead_type.'\','.$r->cost.')" class="type-edit btn btn-warning btn-xs" title="'.lang("ctn_55").'" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("leads/delete_type/" . $r->id . "/" ).'" class="btn btn-danger btn-xs" onclick="return confirm(\''.lang("ctn_317").'\')" title="'.lang("ctn_57").'" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-trash"></span></a>'
			);
		}
		echo json_encode($this->datatables->process());
	}

	
	public function submit() 
	{
		$is_delete = $this->common->nohtml($this->input->post("is_delete"));
		
		$id = $this->common->nohtml($this->input->post("lead_id"));	
					
		if($is_delete==1)
		{
			$this->user_model->delete_lead($id);
		}
		else
		{
			$this->user_model->undelete_lead($id);
		}
		
		redirect(site_url("leads/index"));
		
	}
	public function submit_type() 
	{
		
		$id = intval($this->common->nohtml($this->input->post("id")));
		
		$lead_type = $this->common->nohtml($this->input->post("lead_type"));
		
		$cost = $this->common->nohtml($this->input->post("cost"));	
		
		if($id==-1)
		{
			$this->user_model->add_lead_type($lead_type,$cost);
		}
		else
		{
			$this->user_model->update_lead_type($id,$lead_type,$cost);
		}
		redirect(site_url("leads/types"));		
	}
	
	public function delete_type($id)
	{
		$lead_type_id  = intval($id);	
		
		$this->user_model->delete_lead_type($lead_type_id);
		
		redirect(site_url("leads/types"));
	}
}

?>