<?php

class User_Model extends CI_Model 
{

	public function getUser($email, $pass) 
	{
		return $this->db->select("ID")
		->where("email", $email)->where("password", $pass)->get("users");
	}

	public function get_user_by_id($userid) 
	{
		return $this->db->where("ID", $userid)->get("users");
	}

	public function get_user_by_username($username) 
	{
		return $this->db->where("username", $username)->get("users");
	}

	public function delete_user($id) 
	{
		$this->db->where("ID", $id)->delete("users");
	}

	public function get_new_members($limit) 
	{
		return $this->db->select("email, username, joined, oauth_provider, 
			avatar")
		->order_by("ID", "DESC")->limit($limit)->get("users");
	}

	public function get_registered_users_date($month, $year) 
	{
		$s= $this->db->where("joined_date", $month . "-" . $year)->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_oauth_count($provider) 
	{
		$s= $this->db->where("oauth_provider", $provider)->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_total_members_count() 
	{
		$s= $this->db->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_active_today_count() 
	{
		$s= $this->db->where("online_timestamp >", time() - 3600*24)->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_new_today_count() 
	{
		$s= $this->db->where("joined >", time() - 3600*24)->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_online_count() 
	{
		$s= $this->db->where("online_timestamp >", time() - 60*15)->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_members($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"users.username",
			"users.first_name",
			"users.phone_no",
			"users.last_name",
			"user_roles.name"
			)
		);

		return $this->db->select("users.username, users.email, users.first_name, 
			users.last_name,users.phone_no, users.ID, users.joined, users.oauth_provider,
			users.user_role, users.online_timestamp, users.avatar,
			user_roles.name as user_role_name")
		->join("user_roles", "user_roles.ID = users.user_role", 
				 	"left outer")
		->limit($datatable->length, $datatable->start)
		->get("users");
	}

	public function get_members_admin($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"users.username",
			"users.first_name",
			"users.last_name",
			"users.phone_no",
			"user_roles.name",
			"users.email"
			)
		);

		return $this->db->select("users.username, users.email, users.first_name, 
			users.last_name,users.phone_no, users.ID, users.joined, users.oauth_provider,
			users.user_role, users.online_timestamp, users.avatar,
			user_roles.name as user_role_name")
		->join("user_roles", "user_roles.ID = users.user_role", 
				 	"left outer")
		->limit($datatable->length, $datatable->start)
		->get("users");
	}

	public function get_members_by_search($search) 
	{
		return $this->db->select("users.username, users.first_name, 
			users.last_name, users.ID, users.joined, users.oauth_provider,
			users.user_role, user_roles.name as user_role_name")
		->join("user_roles", "user_roles.ID = users.user_role", 
				 	"left outer")
		->limit(20)
		->like("users.username", $search)
		->get("users");
	}

	public function search_by_username($search) 
	{
		return $this->db->select("users.username, users.email, users.first_name, 
			users.last_name,users.phone_no, users.ID, users.joined, users.oauth_provider,
			users.user_role, user_roles.name as user_role_name")
		->join("user_roles", "user_roles.ID = users.user_role", 
				 	"left outer")
		->limit(20)
		->like("users.username", $search)
		->get("users");
	}

	public function search_by_email($search) 
	{
		return $this->db->select("users.username, users.email, users.first_name, 
			users.last_name,users.phone_no, users.ID, users.joined, users.oauth_provider,
			users.user_role, user_roles.name as user_role_name")
		->join("user_roles", "user_roles.ID = users.user_role", 
				 	"left outer")
		->limit(20)
		->like("users.email", $search)
		->get("users");
	}

	public function search_by_first_name($search) 
	{
		return $this->db->select("users.username, users.email, users.first_name, 
			users.last_name,users.phone_no, users.ID, users.joined, users.oauth_provider,
			users.user_role, user_roles.name as user_role_name")
		->join("user_roles", "user_roles.ID = users.user_role", 
				 	"left outer")
		->limit(20)
		->like("users.first_name", $search)
		->get("users");
	}

	public function search_by_last_name($search) 
	{
		return $this->db->select("users.username, users.email, users.first_name, 
			users.last_name,users.phone_no, users.ID, users.joined, users.oauth_provider,
			users.user_role, user_roles.name as user_role_name")
		->join("user_roles", "user_roles.ID = users.user_role", 
				 	"left outer")
		->limit(20)
		->like("users.last_name", $search)
		->get("users");
	}

	public function update_user($userid, $data) {
		$this->db->where("ID", $userid)->update("users", $data);
	}

	public function check_block_ip() 
	{
		$s = $this->db->where("IP", $_SERVER['REMOTE_ADDR'])->get("ip_block");
		if($s->num_rows() == 0) return false;
		return true;
	}

	public function get_user_groups($userid) 
	{
		return $this->db->where("user_group_users.userid", $userid)
			->select("user_groups.name,user_groups.ID as groupid")
			->join("user_groups", "user_groups.ID = user_group_users.groupid")
			->get("user_group_users");
	}

	public function check_user_in_group($userid, $groupid) 
	{
		$s = $this->db->where("userid", $userid)->where("groupid", $groupid)
			->get("user_group_users");
		if($s->num_rows() == 0) return 0;
		return 1;
	}

	public function get_default_groups() 
	{
		return $this->db->where("default", 1)->get("user_groups");
	}

	public function add_user_to_group($userid, $groupid) 
	{
		$this->db->insert("user_group_users", array(
			"userid" => $userid, 
			"groupid" => $groupid
			)
		);
	}

	public function add_points($userid, $points) 
	{
        $this->db->where("ID", $userid)
        	->set("points", "points+$points", FALSE)->update("users");
    }

    public function get_verify_user($code, $username) 
    {
    	return $this->db
    		->where("activate_code", $code)
    		->where("username", $username)
    		->get("users");
    }

    public function get_user_event($request) 
    {
    	return $this->db->where("IP", $_SERVER['REMOTE_ADDR'])
    		->where("event", $request)
    		->order_by("ID", "DESC")
    		->get("user_events");
    }

    public function add_user_event($data) 
    {
    	$this->db->insert("user_events", $data);
    }

    public function get_custom_fields($data) 
	{
		if(isset($data['register'])) {
			$this->db->where("register", 1);
		}
		return $this->db->get("custom_fields");
	}

	public function add_custom_field($data) 
	{
		$this->db->insert("user_custom_fields", $data);
	}

	public function get_custom_fields_answers($data, $userid) 
	{
		if(isset($data['edit'])) {
			$this->db->where("custom_fields.edit", 1);
		}
		return $this->db
			->select("custom_fields.ID, custom_fields.name, custom_fields.type,
				custom_fields.required, custom_fields.help_text,
				custom_fields.options,
				user_custom_fields.value")
			->join("user_custom_fields", "user_custom_fields.fieldid = custom_fields.ID
			 AND user_custom_fields.userid = " . $userid, "LEFT OUTER")
			->get("custom_fields");

	}

	public function get_user_cf($fieldid, $userid)
	{
		return $this->db
			->where("fieldid", $fieldid)
			->where("userid", $userid)
			->get("user_custom_fields");
	}

	public function update_custom_field($fieldid, $userid, $value) 
	{
		$this->db->where("fieldid", $fieldid)
			->where("userid", $userid)
			->update("user_custom_fields", array("value" => $value));
	}

	public function get_payment_logs($userid, $datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"users.username",
			"payment_logs.email"
			)
		);
		return $this->db
			->where("payment_logs.userid", $userid)
			->select("users.ID as userid, users.username, users.email,
			users.avatar, users.online_timestamp,
			payment_logs.email, payment_logs.amount, payment_logs.timestamp, 
			payment_logs.ID, payment_logs.processor")
			->join("users", "users.ID = payment_logs.userid")
			->limit($datatable->length, $datatable->start)
			->get("payment_logs");
	}

	public function get_total_payment_logs_count($userid) 
	{
		$s= $this->db
			->where("userid", $userid)
			->select("COUNT(*) as num")->get("payment_logs");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}
	//Lead purchased so far
    public function get_all_time_purchases($phone_no) 
	{
		$s= $this->db
			->where("phone_no", $phone_no)			
			->select("COUNT(*) as num")->get("customer_purchases");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	
	}
	//Lead purchased today
	public function get_leads_purchased_today($phone_no) 
	{
		$s= $this->db
			->where("phone_no", $phone_no)
			->where("DATE_FORMAT(FROM_UNIXTIME(purchased_timestamp),'%Y%c%d')=DATE_FORMAT(now(),'%Y%c%d')")			
			->select("COUNT(*) as num")->get("customer_purchases");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	
	}
	//Amount spend life time
	public function get_amount_spent_all_time($phone_no) 
	{
		$s= $this->db
			->where("phone_no", $phone_no)						
			->select("SUM(cost) as num")->get("customer_purchases");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	
	}
	//Amount spend today
	public function get_amount_spent_today($phone_no) 
	{
		$s= $this->db
			->where("phone_no", $phone_no)		
			->where("DATE_FORMAT(FROM_UNIXTIME(purchased_timestamp),'%Y%c%d')=DATE_FORMAT(now(),'%Y%c%d')")			
			->select("SUM(cost) as num")
			->get("customer_purchases");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	
	}
	
	public function get_user_spendings_each_month($phone_no,$month, $year) 
	{		
		$s= $this->db
		    ->where("phone_no",$phone_no)
			->where("purchase_date", $month . "-" . $year)			
			->select("SUM(cost) as num")
			->get("v_customer_purchases");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}
	
	public function get_user_leads_each_month($phone_no,$month, $year) 
	{		
		$s= $this->db
		    ->where("phone_no",$phone_no)
			->where("purchase_date", $month . "-" . $year)			
			->select("COUNT(*) as num")
			->get("v_customer_purchases");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}
	public function get_all_leads_each_month($month, $year) 
	{		
		$s= $this->db
		    ->where("purchase_date", $month . "-" . $year)			
			->select("COUNT(*) as num")
			->get("v_customer_purchases");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}
	public function get_all_leads() 
	{		
		return $this->db	
                ->select("id,name,email,phone,token,aff_id,ip, DATE_FORMAT(FROM_UNIXTIME(timestamp),'%Y%c%d') as created_date,lead_types")
				->get('questionnaire');

	}
	public function get_all_deleted_leads() 
	{		
		return $this->db	
                ->select("id,name,email,phone,token,aff_id,ip, DATE_FORMAT(FROM_UNIXTIME(timestamp),'%Y%c%d') as created_date,lead_types")
				->get('questionnaire_deleted');

	}
	public function get_leads_purchased($phone_no) 
	{		
		return $this->db
			->where("phone_no", $phone_no)			
            ->select("id,name,email,phone,token,aff_id,purchased_date,phone_no,lead_types")
			->get("v_lead_purchases");
		
	}
	
	public function get_leads_purchased_all_users() 
	{		
		return $this->db					
            ->select("id,name,email,phone,token,aff_id,purchased_date,phone_no,lead_types")
			->get("v_lead_purchases");
		
	}
	
	public function get_leads_reversed() 
	{		
		return $this->db					
            ->select("id,name,email,phone,token,aff_id,purchased_date,phone_no,lead_types")
			->get("v_lead_reversals");
		
	}
	
	//Lead generated today
	public function get_leads_generated_today() 
	{
		$s= $this->db
			->where("DATE_FORMAT(FROM_UNIXTIME(purchased_timestamp),'%Y%c%d')=DATE_FORMAT(now(),'%Y%c%d')")			
			->select("COUNT(*) as num")->get("customer_purchases");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	
	}
	//Lead generated all time
	public function get_leads_generated_all() 
	{
		$s= $this->db			
			->select("COUNT(*) as num")->get("customer_purchases");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	
	}
	
	//Lead generated today
	public function get_leads_sold_today() 
	{
		$s= $this->db
			->where("DATE_FORMAT(FROM_UNIXTIME(purchased_timestamp),'%Y%c%d')=DATE_FORMAT(now(),'%Y%c%d')")			
			->select("COUNT(*) as num")->get("customer_purchases");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	
	}
	
	//Amount spend life time
	public function get_leads_spent_all_time() 
	{
		$s= $this->db
			->select("SUM(cost) as num")->get("customer_purchases");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	
	}
	//Amount spend today
	public function get_leads_spent_today() 
	{
		$s= $this->db
			->where("DATE_FORMAT(FROM_UNIXTIME(purchased_timestamp),'%Y%c%d')=DATE_FORMAT(now(),'%Y%c%d')")			
			->select("SUM(cost) as num")
			->get("customer_purchases");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	
	}
	public function get_customer_purchase($id) 
	{
		$s= $this->db
			->where("id",$id)			
            ->select("id,stripeEmail_email_username,stripeToken,token,purchased_timestamp,cost,phone_no,lead_types")
			->get("customer_purchases");
		
		return $s->row();
			
	}
	public function get_customer_reversal($id) 
	{
		$s= $this->db
			->where("id",$id)	
            ->select("id,stripeEmail_email_username,stripeToken,token,purchased_timestamp,cost,phone_no,lead_types")
			->get("customer_reversals");
		return $s->row();
			
	}
	//Reverse customer purchases
	public function reverse_customer_purchase($id)
	{
		try{
			$lead_purchased = $this->get_customer_purchase($id);
			if(!empty($lead_purchased))
			{
				//insert into customer_reversals table first
				$this->db->insert("customer_reversals", array(
					"stripeEmail_email_username" => $lead_purchased->stripeEmail_email_username, 
					"stripeToken" => $lead_purchased->stripeToken,
					"token" => $lead_purchased->token,
					"purchased_timestamp" => $lead_purchased->purchased_timestamp,
					"cost" => $lead_purchased->cost,
					"phone_no" => $lead_purchased->phone_no,
					"lead_types" => $lead_purchased->lead_types
					)
				);
				
				//Delete from customer purchased table			
				$this->db->where("id", $lead_purchased->id)->delete("customer_purchases");
			}
		}
		catch(Exception $ex)
		{
			echo $ex->getMessage();
		}		
	}	
	
	public function unreverse($id)
	{
		try{
			$lead_purchased = $this->get_customer_reversal($id);
			if(!empty($lead_purchased))
			{
				//insert into customer_reversals table first
				$this->db->insert("customer_purchases", array(
					"stripeEmail_email_username" => $lead_purchased->stripeEmail_email_username, 
					"stripeToken" => $lead_purchased->stripeToken,
					"token" => $lead_purchased->token,
					"purchased_timestamp" => $lead_purchased->purchased_timestamp,
					"cost" => $lead_purchased->cost,
					"phone_no" => $lead_purchased->phone_no,
					)
				);
				
				//Delete from customer purchased table			
				$this->db->where("id", $lead_purchased->id)->delete("customer_reversals");
			}
		}
		catch(Exception $ex)
		{
			echo $ex->getMessage();
		}		
	}
	
	
	public function get_lead($id) 
	{
		$s= $this->db
			->where("id",$id)			
			->get("questionnaire");
		
		return $s->row();
			
	}
	public function get_deleted_lead($id) 
	{
		$s= $this->db
			->where("id",$id)				
			->get("questionnaire_deleted");
		return $s->row();
			
	}
	//Delete lead
	public function delete_lead($id)
	{
		try{
			$lead = $this->get_lead($id);
			if(!empty($lead))
			{				
				$this->db->insert("questionnaire_deleted",Array(
					'ip'=>$lead->ip,
					'email'=>$lead->email,
					'phone'=>$lead->phone, 
					'name'=>$lead->name, 
					'timestamp'=>$lead->timestamp, 
					'token'=>$lead->token,
					'aff_id'=>$lead->aff_id,
					'click_hash'=>$lead->click_hash,
					'failed'=>$lead->failed,
					'has_submitted'=>$lead->has_submitted,
                    'deleted_timestamp'=>time(),
                    'lead_types'=>$lead->lead_types
				));

				$this->db->where("id", $lead->id)->delete("questionnaire");
			}
		}
		catch(Exception $ex)
		{
			echo $ex->getMessage();
		}		
	}	
	
	public function undelete_lead($id)
	{
			try{
			$lead = $this->get_deleted_lead($id);
			if(!empty($lead))
			{				
				$this->db->insert("questionnaire",Array(
					'ip'=>$lead->ip,
					'email'=>$lead->email,
					'phone'=>$lead->phone, 
					'name'=>$lead->name, 
					'timestamp'=>$lead->timestamp, 
					'token'=>$lead->token,
					'aff_id'=>$lead->aff_id,
					'click_hash'=>$lead->click_hash,
					'failed'=>$lead->failed,
                    'has_submitted'=>$lead->has_submitted,
                    'lead_types'=>$lead->lead_types
				));

				$this->db->where("id", $lead->id)->delete("questionnaire_deleted");
			}
		}
		catch(Exception $ex)
		{
			echo $ex->getMessage();
		}	
	}
	
	
	
	public function get_options() 
	{
		$s= $this->db			
			->select("id,header_color,button_color,button_hover_color,button_border_color,lead_sms_template,charge_sms_template,monetizecontact_background_color,monetizecontact_redirect,lead_cost,lead_rate_limit")
			->get("custom_settings");
		return $s->row();
			
	}
	public function get_app_keys() 
	{
		$s= $this->db	
			->where("1=1")
			->select("id,stripe_secret_key,stripe_publishable_key,twilio_sid,twilio_auth_token,twilio_phone_number")
			->get("app_keys");
		return $s->row();
			
	}
	public function save_app_keys($id,$stripe_secret_key,$stripe_publishable_key,$twilio_sid,$twilio_auth_token,$twilio_phone_number)
	{
		try{
			if(isset($id))
			{
				$this->db->where("id", $id)->update("app_keys", array(
					"stripe_secret_key" => $stripe_secret_key, 
					"stripe_publishable_key" => $stripe_publishable_key,
					//"twilio_sid" => $twilio_sid,
					//"twilio_auth_token" => $twilio_auth_token,
					//"twilio_phone_number" => $twilio_phone_number
					)
				);
			}
			else
			{		
				$this->db->insert("app_keys", array(
					"stripe_secret_key" => $stripe_secret_key, 
					"stripe_publishable_key" => $stripe_publishable_key,
					//"twilio_sid" => $twilio_sid,
					//"twilio_auth_token" => $twilio_auth_token,
					//"twilio_phone_number" => $twilio_phone_number
					)
				);
			}		
			
		}
		catch(Exception $ex)
		{
			echo $ex->getMessage();
		}		
	}	
	public function save_customization($lead_sms_template,$charge_sms_template,$header_color,$button_color,$button_hover_color,$button_border_color,$monetizecontact_background_color,$monetizecontact_redirect,$lead_cost,$lead_rate_limit)
	{
		try{
			// if(isset($id))
			// {
				// $this->db->where("id", $id)->update("custom_settings", array(
					// "lead_sms_template" => lead_sms_template, 
					// "charge_sms_template" => charge_sms_template,
					// "header_color" => header_color,
					// "button_color" => button_color,
					// "button_border_color" => button_border_color
					// )
				// );
			// }
			// else
			{		
				//delete previous settings first
				$this->db->where("1=1")->delete("custom_settings");
				$this->db->insert("custom_settings", array(
					"lead_sms_template" => $lead_sms_template, 
					"charge_sms_template" => $charge_sms_template,
					"header_color" => $header_color,
					"button_color" => $button_color,
					"button_hover_color"=>$button_hover_color,
					"button_border_color" => $button_border_color,
					"monetizecontact_background_color" => $monetizecontact_background_color,
					"monetizecontact_redirect" => $monetizecontact_redirect,
					"lead_cost" => $lead_cost,
					"lead_rate_limit" => $lead_rate_limit
					)
				);
			}		
			
		}
		catch(Exception $ex)
		{
			echo $ex->getMessage();
		}		
	}	

    public function get_admin_lead_types($datatable) 
    {
        $datatable->db_order();  
 
        return $this->db
                ->limit($datatable->length, $datatable->start)
                ->get("lead_types");
            
    }
    public function get_all_lead_types() 
    {
        return $this->db             
                ->get("lead_types");
            
    }
    public function get_admin_lead_type_count() 
    {
        $s= $this->db->select("COUNT(*) as num")->get("lead_types");
        $r = $s->row();
        if(isset($r->num)) return $r->num;
        return 0;
    }
    public function add_lead_type($lead_type,$cost)
    {
        $this->db->insert("lead_types",Array(
                    'lead_type'=>$lead_type,
                    'cost'=>$cost
                ));
    }   
    public function update_lead_type($id,$lead_type,$cost)
    {
        $this->db
                 ->where('id',$id)
                 ->update("lead_types",Array(
                    'lead_type'=>$lead_type,
                    'cost'=>$cost
                ));
    }
    public function delete_lead_type($lead_type_id)
    {
        $this->db
                ->where('id',$lead_type_id)
                ->delete("lead_types");
    }   
    
    
    public function get_lead_types_by_user_id($user_id) 
    {
        //get all lead types first
        $lead_types = $this->db
                            ->get("lead_types")->result();
                            
                            
        $user_lead_types = $this->db
                ->where('user_id',$user_id)
                ->get("user_lead_types")->result();
        //if(!empty($leady_types))
        {
            foreach($lead_types as $type)
            {
                $is_selected = false;
                foreach($user_lead_types as $user_lead)
                {
                    if($user_lead->lead_type_id == $type->id)
                    {
                        $is_selected = true;
                        break;
                    }
                }
                $type->is_selected = $is_selected;
            }
        }
        return $lead_types;     
    }
    
    public function save_user_lead_types($user_id, $lead_type_ids)
    {       
        //delete previous selected types first
        $this->db->where('user_id',$user_id)->delete("user_lead_types");
        //insert new ones
        
        foreach($lead_type_ids as $id)
        {
            $this->db->insert("user_lead_types",array(
                                "user_id"=>$user_id,
                                "lead_type_id"=>$id
                            ));
        }
    }
    
    
}
 
?>