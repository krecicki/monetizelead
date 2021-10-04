<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Options extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");

		if(!$this->user->loggedin) $this->template->error(lang("error_1"));
		
		$this->template->loadData("activeLink", 
			array("options" => array("general" => 1)));
	}

	public function index() 
	{
		$options = $this->user_model->get_options();
		$app_keys = $this->user_model->get_app_keys();
		
		$lead_types = $this->user_model->get_all_lead_types();
		
		$this->template->loadContent("options/index.php", array(
			"options"=>$options,
			"app_keys"=>$app_keys,
			"lead_types"=>$lead_types
			)
		);
	}
	
	
	public function save() 
	{
		$lead_sms_template = $this->common->nohtml($this->input->post("lead_sms_template"));
		$charge_sms_template = $this->common->nohtml($this->input->post("charge_sms_template"));
		$header_color = $this->common->nohtml($this->input->post("header_color"));
		$button_color = $this->common->nohtml($this->input->post("button_color"));
		$button_hover_color = $this->common->nohtml($this->input->post("button_hover_color"));
		$button_border_color = $this->common->nohtml($this->input->post("button_border_color"));
		
		$lead_cost = $this->common->nohtml($this->input->post("lead_cost"));
		
		//app keys as well
		
		$id = $this->common->nohtml($this->input->post("id"));	
		$stripe_secret_key = $this->common->nohtml($this->input->post("stripe_secret_key"));		
		$stripe_publishable_key = $this->common->nohtml($this->input->post("stripe_publishable_key"));		
		$twilio_sid = $this->common->nohtml($this->input->post("twilio_sid"));		
     	$twilio_auth_token = $this->common->nohtml($this->input->post("twilio_auth_token"));
     	$twilio_phone_number = $this->common->nohtml($this->input->post("twilio_phone_number"));
	
		$this->user_model->save_customization($lead_sms_template,$charge_sms_template,$header_color,$button_color,$button_hover_color,$button_border_color,$lead_cost);
		
		$this->user_model->save_app_keys($id,$stripe_secret_key,$stripe_publishable_key,$twilio_sid,$twilio_auth_token,$twilio_phone_number);	
		
		redirect(site_url("Options/index"));
	
	}

}

?>