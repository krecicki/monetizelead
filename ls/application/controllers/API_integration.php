<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class API_integration extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");

		if(!$this->user->loggedin) $this->template->error(lang("error_1"));
		
		$this->template->loadData("activeLink", 
			array("api" => array("general" => 1)));
	}

	public function index() 
	{
		
		$this->template->loadContent("api_integration/index.php", array(
			
			)
		);
	}

}

?>