<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_reversals extends CI_Controller 
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
			array("reversals" => array("general" => 1)));
        
		$leads = $this->user_model->get_leads_purchased_all_users();
		$lead_reversals = $this->user_model->get_leads_reversed();
		
		// Loads HTML page
		$this->template->loadContent("user_reversals/index.php", array(
			"leads"=>$leads,
			"leads_reversals"=>$lead_reversals
			)
		);
	}
	
	public function submit() 
	{
		$is_reverse = $this->common->nohtml($this->input->post("is_reverse"));
		
		$id = $this->common->nohtml($this->input->post("lead_id"));	
					
		if($is_reverse==1)
		{
			$this->user_model->reverse_customer_purchase($id);
		}
		else
		{
			$this->user_model->unreverse($id);
		}
		
		redirect(site_url("user_reversals/index"));
		
	}
}

?>