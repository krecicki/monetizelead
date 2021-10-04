<?php

class Reversal_Model extends CI_Model 
{

	public function reverse_purchases() 
	{
		$tokens = $this->common->nohtml($this->input->post("tokens"));
		print_r($tokens);
		die();
		//$this->db->where("ID", $id)->update("payment_plans", $data);
	}


}

?>