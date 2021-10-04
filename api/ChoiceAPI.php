<?php header('Access-Control-Allow-Origin: *'); 
require_once('../config.php');
require_once 'API.class.php';
class ChoiceAPI extends API
{
    protected $User;
	protected $apiKey;
	protected $token;
	
	protected $_db= null;

    public function __construct($request, $origin) {
        parent::__construct($request);		
		
		global $db;
		
		//$_db = $db;
	}
	
	// Get the client's IP address
	private function get_client_ip() {
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];
		$ip ="";
		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}

		return $ip;
	}	
	//generate random token
	private function generate_uuid() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
				mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
				mt_rand( 0, 0xffff ),
				mt_rand( 0, 0x0C2f ) | 0x4000,
				mt_rand( 0, 0x3fff ) | 0x8000,
				mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
		);
	}
	private function sanitize($val){
	    $output='';
		$output = str_replace("'", "''", $output); 
		$output = preg_replace("/(\\\)/si", '\\\\\1', $val);
		$output = strip_tags($output);
		$output = str_replace(array("\r\n", "\n", "'", "<script>", "</script>", "<noscript>", "</noscript>"), array("\\n", "\\n", "\'", "\\x3Cscript\\x3E", "\\x3C/script\\x3E", "\\x3Cnoscript\\x3E", "\\x3C/noscript\\x3E"), $output);
		
		return $output;
	}
	private function verify_api_key($key)
	{
		global $db;
		try{
			//$query = mysql_query("SELECT count(*) as key_count from api_keys WHERE api_key='$key'");
			$row = $db->where('api_key',$key)
						->getOne("api_keys");
						
			$cout =0;	
			//while($row = mysql_fetch_array($query))
			if(!empty($row))
			{
				$count= 1;
			}
			return $count > 0;
		}
		catch(Exception $ex)
		{
			echo json_encode(Array('status'=>'fail','message'=>$ex->getMessage()));
			exit;
			return false;
		}
		return false;
	}
	private function has_lead_type_selected($user_id,$tags){
		//global $db,$tags; // At this point, php checs for the global var tags that is not defined. So the input you sent here. (It checks for the global var defined as tags, that is empty)
		global $db; // It takes from the below line where you are calling the function

		$lead_types = explode(',',$tags);
		$user_lead_types = $db
						->where('user_id',$user_id)
						->where('lead_type_id', $lead_types, 'IN')
						->get('user_lead_types');			

		return sizeof($user_lead_types) > 0;
	
	}
    /**
     * lead_gen Endpoint
    */
    protected function lead_gen() {
		
		global $db;
		//$hours_limit = 2592000;
		$limit_message =  'You have completed the questionnaire in the past '.($hours_limit/3600).' hours.';
		
		$has_already_submitted = false;
		$check_query = $db
						->where('ip',$_SERVER['REMOTE_ADDR'])
						->where('timestamp',(time() - $hours_limit),">")
						->getOne('questionnaire');

		if(!empty($check_query))
			$has_already_submitted = true;
			
		if($has_already_submitted){
			//wait until time limit complete
			echo json_encode(Array('status'=>'fail','message'=>$limit_message));
			exit;
		}
		if(!$this->verify_api_key($this->apiKey))
		{
			echo json_encode(Array('status'=>'fail','message'=>'Invalid API Key'));
			exit;
		}
		try
		{
			$posted_name = $this->sanitize($this->request['leadData']['name']);
			$posted_zipcode = $this->sanitize($this->request['leadData']['zipcode']);
			$posted_email = $this->sanitize($this->request['leadData']['email']);
			$posted_phone = $this->sanitize($this->request['leadData']['phone']);
			$posted_notes = $this->sanitize($this->request['leadData']['notes']);
			
			//Get lead types from API post and create $tags 
			$lead_types = $this->request['leadData']['lead_types'];
			$strTags = array();
			if(!empty($lead_types))
				$strTags = explode(',',$lead_types);
			
			$tags = '';
			
			$lead_types_objects = $db->where('lead_type', $strTags,'IN')->get('lead_types');
			
			foreach($lead_types_objects as $l)
			{
				if($tags=='')
					$tags = $l['id'];
				else
					$tags.=',' .$l['id'];
			}

			//Send SMS & then Insert lead into database	from API post		
			
			$tokenid = $this->generate_uuid();
			$tokenteam = $this->generate_uuid();

			//Send to anyone who wants that lead with whatever tags sent
			$people = $db
				->where("phone_no","","!=")
				->where("user_role","1","!=")
				->get("users");
			
			//Gets text message template from user settings
			$lead_sms_query = $db->getOne("custom_settings");
			if(!empty($lead_sms_query))
				$lead_sms_template = $lead_sms_query['lead_sms_template'];

			//Gets twilio purchased phone number from app_keys table
			$twilio_phone_query = $db->getOne("app_keys");
			if(!empty($twilio_phone_query))
				$twilio_phone_number = $twilio_phone_query['twilio_phone_number'];
			
			// Use the REST API Client to make requests to the Twilio REST API

			require __DIR__ . '/../sms/Twilio/autoload.php';

			global $sid,$token;
			$client = new Twilio\Rest\Client($sid, $token);
			
			$content_data = [		  
				"leadname" => $posted_name,
				"leadzipcode" => $posted_zipcode,
				"leadphone" => $posted_phone,
				"leademail" => $posted_email,
				"leadnotes" => $posted_notes,
				"leadtags" => $lead_types			
				];
		
			//Replace Content
			foreach($content_data as $index => $value){
				$lead_sms_template = str_replace("|".$index."|", $value, $lead_sms_template);
			}
			
			// Step 5: Loop over all our friends. $number is a phone number above, and 
			// $name is the name next to it
			$sms_qty = 0;
			foreach ($people as $person) {
				try{
					//commented temporarily -- uncommented below to try to solve issue of texting everyone still
					if($this->has_lead_type_selected($person['ID'],$tags))
					{
						
						$uid = $person['ID'];
						$number = $person['phone_no'];
						$name = $person['first_name']. ' '. $person['last_name'];
						$sms_text = $lead_sms_template;
						//$lead_url = 'https://4mny.com/exchange/stripe/form.php?tokenid='.$tokenid.'&ntoken='. base64_encode($number);
						$lead_url = 'https://monetizelead.com/client/{USERNAME}/stripe/form.php?tokenid='.$tokenid.'&ntoken='. base64_encode($number);
						// this link goes to the accept button and not a purchase button
						$team_url = 'https://monetizelead.com/client/{USERNAME}/stripe/form_team.php?tokent='.$tokenteam.'&uid='.base64_encode($uid).'&tokenid='.$tokenid.'&ntoken='. base64_encode($number);
						//Get notes text
						//tag to use for purchase link
						$sms_text = str_replace("|leadurl|", $lead_url, $sms_text);
						// tag to use for accept link
						$sms_text = str_replace("|teamurl|", $team_url, $sms_text);
						$sms_text = str_replace("|username|", $name, $sms_text);
						$sms_text = str_replace("|notes|", $posted_notes, $sms_text);
						
						$sms = $client->account->messages->create(

						// the number we are sending to - Any phone number
						$number,

						array(
							// Step 6: Change the 'From' number below to be a valid Twilio number 
							// that you've purchased
							'from' => $twilio_phone_number, 						
							// the sms body
							'body' => $sms_text
                                                        //'body' => "Hey, $name, you have $nameStar from the zipcode $zipcodeStar waiting for you to call them at $phoneStar or email them at $emailStar. They just submitted this information moments ago. Buy the lead here https://monetizelead.com/client/july222018/stripe/form.php?tokenid=$tokenid&ntoken=". base64_encode($number)							
						)
					  );
					  $sms_qty = $sms_qty + 1;
					}
				}
				catch(Exception $ex)
				{
					//echo json_encode(Array('status'=>'fail','error'=>$ex->getMessage()));
					//exit;	
				}								
			}			
						
			// Repleaced INSERT INTO for UPDATE in the below else statement
			//mysql_query("INSERT INTO questionnaire(ip, email, phone, name, timestamp, token,has_submitted) VALUES('".$_SERVER['REMOTE_ADDR']."', '".$posted_email."', '".$posted_phone."', '".$posted_name."', '".time()."', '".$tokenid."',1)");
	
				
				$db->insert("questionnaire",Array(
				'ip'=>$_SERVER['REMOTE_ADDR'],
				'email'=>$posted_email,
				'phone'=>$posted_phone, 
				'name'=>$posted_name, 
				'timestamp'=>time(), 
				'token'=>$tokenid,
				'has_submitted'=>1,
				'lead_types'=>$lead_types,
				'notes'=>$posted_notes
			));
			
				//COUNT ALL SMS SENT
				if($sms_qty != 0){
					\Stripe\Stripe::setApiKey("YOUR LIVE KEY HERE"); //change to your live key
					\Stripe\UsageRecord::create(array(
					  "quantity" => $sms_qty,
					  "timestamp" => time(),
					  "subscription_item" => STRIP_SUBSCRIPTION_ID
					));
				}
		
			
		}
		catch(Exception $ex)
		{
			echo json_encode(Array('status'=>'fail','message'=>$ex->getMessage()));
			exit;
		}
		echo json_encode(Array('status'=>'success','message'=>'Lead generated', 'request'=>$this->request));		
    }
	 
	public function processApi(){
		//echo json_encode(Array('request'=> $this->request));
		$this->apiKey = $this->request['leadData']['apiKey']; 
		$func = strtolower(trim(str_replace("/","",$_REQUEST['action'])));
	   
		if((int)method_exists($this,$func) > 0)
			$this->$func();
		else
			$this->response('Endpoint not found!',404);				
	}

	public function response($data,$status){		
		echo $data;			
	}
 }
 ?>