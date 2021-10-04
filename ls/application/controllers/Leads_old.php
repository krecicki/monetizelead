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
}

?>