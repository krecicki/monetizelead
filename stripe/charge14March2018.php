<?php require_once('../config.php'); ?>
<?php
// Begin error reporting and ob
error_reporting(E_ALL);
ob_start();

// Get the clients IP address
function get_client_ip() {
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

$row = $db->getOne('custom_settings');
if(!empty($row))
{
	$button_color = $row['button_color'];
	$button_hover_color = $row['button_hover_color'];
	$button_border_color = $row['button_border_color'];
	$header_color = $row['header_color'];
	$lead_cost = $row['lead_cost'];
}


function send_sms($first_name,$last_name,$phone_no,$lead_name,$phone,$email,$aff_id,$click_hash,$tokenid,$cost)
{
	try{
		require __DIR__ . '/../sms/Twilio/autoload.php';
		// Your Account SID and Auth Token from twilio.com/console
		//$sid = 'AC81d677b40f25864456091d1633af226e';
		//$token = '796e83917963d8733aa29fc3a272a12c';
		global $db;
		
		$row = $db->getOne('app_keys');

		if(!empty($row))
		{
			$sid = $row['twilio_sid'];
			$token = $row['twilio_auth_token'];
		}
		$client = new Twilio\Rest\Client($sid, $token);    
		$name = $first_name.' '. $last_name;
		
		$content_data = [		
			"leadname"=>$lead_name,
			"username"=>$name,
			"email"=>$email,
			"phone"=>$phone,
			"token"=>$tokenid,
			"click_hash"=>$click_hash,
			"affilate_id"=>$aff_id,
			"cost"=>$aggregated_cost
		];
		
		//Get reciept template from user options page
		$row = $db->getOne('custom_settings');
		if(!empty($row))
		{
			$charge_sms_template = $row['charge_sms_template'];
			$header_color = $row['header_color'];
		}

		//Get phone twilio purchased phone number
		$row = $db->getOne('app_keys');
		if(!empty($row))
		{
			$twilio_phone = $row['twilio_phone_number'];
		}

		//Replace Content
		foreach($content_data as $index => $value){
			$charge_sms_template = str_replace("|".$index."|", $value, $charge_sms_template);
		}
		$sms = $client->account->messages->create(
				// the number we are sending to - Any phone number
				$phone_no,
				array(
					// Step 6: Change the 'From' number below to be a valid Twilio number 
					// that you've purchased
					'from' => $twilio_phone, 					
					// the sms body
					'body'=>$charge_sms_template
					//'body' => "Hey, $name, thanks for buying."
					 // 'body' => "Hey, $name, thanks for buying.\nEmail: $email\nPhone: $phone\nAffiliate Id: $aff_id\nClick Hash: $click_hash\nToken Id: $tokenid"
				)
			);  
	}
    catch(Exception $ex)
	{
		echo $ex->getMessage();
	}	
}
// Get unique token generated on original lead form submit that was inserted in the DB in the leads row
$has_submitted = 0;
$aggregated_cost = 0;

if(isset($_POST['token']))
{	
	$tokenid = $_POST['token'];
	$phone_no = $_POST['ntoken'];
	if(isset($phone_no))
	{
		$has_submitted = 1;
		$phone_no = base64_decode($phone_no);
		if(substr($phone_no,0,2)!= "+1")
			$phone_no = "+1". $phone_no;
	}
	$user= $db
		->where('phone_no',base64_decode($_POST['ntoken']))
		->getOne('users');

	$tags = '';
	$aggregated_cost = 0;

	$user_lead_types = $db
						->where('user_id',$user['ID'])					
						->get('user_lead_types');		
	
	foreach($user_lead_types as $lead_type)
	{
		//get cost of each lead type
		
		$l = $db
				->where('id',$lead_type['lead_type_id'])
				->getOne('lead_types');
		
		$aggregated_cost += doubleval($l['cost']);	
	}

	$lead_cost = $aggregated_cost;

}
if(!empty($tokenid))
{
	// Fetch the row that matches the unique tokenid in the above GET and make functions for its rows column records
	//$tokenidResults = mysql_query("SELECT count(*) AS num_user FROM questionnaire WHERE token = $tokenid");
	 
	
        $row = $db->where('token',$tokenid)
				->getOne('questionnaire');
	    if(!empty($row))
		{
			$name = $row['name'];
			$phone = $row['phone'];
			$email = $row['email'];
			$aff_id = $row['aff_id'];
			$click_hash = $row['clcik_hash'];
			$tokenid = $row['token'];
			//$has_submitted = $row['has_submitted'];
			$units_sold = $row['units_sold'];
		}
				
		if($has_submitted==1)
		{		
		
			try {
				 
				 //Stripe Checkout API
				  //require_once('./config.php');
				   $token  = $_POST['stripeToken'];
				   $stripeEmail =  $_POST['stripeEmail'];
				  
				  $customer = \Stripe\Customer::create(array(
					  'email' => $_POST['stripeEmail'],
					  'card'  => $token
				  ));
				  /*$charge = \Stripe\Charge::create(array(
					  'customer' => $customer->id,
					  'amount'   => 5000,
					  "description" => "You can call $name at $phone or email them at $email. The lead reference number is $tokenid write this down and keep it secret.",
					  "receipt_email" => $_POST['stripeEmail'],
					  "source" => $token,
				  ));*/
				  
				 if(isset($lead_cost))
					 $lead_cost *=100;
				 
				 $charge=  \Stripe\Charge::create(array(
				 "customer" => $customer->id,
				  "amount" => $lead_cost,
				  "currency" => "usd",
				  //"source" => $token, // obtained with Stripe.js
				  "receipt_email" => $stripeEmail,
				  "description" => "You can call $name at $phone or email them at $email. The lead reference number is $tokenid write this down and keep it secret."
				));
				
				if(!is_null($charge))
				{						
					//update the units_sold with +1
					
					mysql_query("UPDATE questionnaire SET units_sold = units_sold+1 WHERE 1=1;");	
					
					//Load the user object based on phone none
										
					$row = $db->where('phone_no',$phone_no)
							->getOne('users');
					
					//while($row = mysql_fetch_array($user_query))
					if(!empty($row))
					{
						$first_name = $row['first_name'];						
						$last_name = $row['last_name'];						
					}	
					//if(isset($name))
					//send_sms($first_name,$last_name,$phone_no,$name,$phone,$email,$aff_id,$click_hash,$tokenid);
					send_sms($first_name,$last_name,$phone_no,$name,$phone,$email,$aff_id,$click_hash,$tokenid,$lead_cost/100);
					//update customer purchases
					//$purchase_query = "INSERT INTO customer_purchases(stripeEmail_email_username, token, purchased_timestamp, stripeToken, units_sold,cost,phone_no) VALUES('".$_POST['stripeEmail']."','".$tokenid."', ".time().", '".$token."', ".$units_sold.",".$lead_cost.",'".$phone_no."')";				
					
					$db->insert('customer_purchases',Array(
						'stripeEmail_email_username'=>$_POST['stripeEmail'], 'token'=>$tokenid, 'purchased_timestamp'=>time(), 'stripeToken'=>$token, 'units_sold'=>$units_sold,'cost'=>($lead_cost/100),'phone_no'=>$phone_no
					));
					//mysql_query($purchase_query);
					
				}
			} 
			catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "<br/>";
			}
		}//End has_submitted condition
		
}
$settings = $db->getOne('site_settings');
$site_logo = $settings['upload_path_relative'].'/'. $settings['site_logo'];	
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Choice Insurance::Post Payment Details</title>

    <!-- Bootstrap Core CSS -->
    <link href="design/css/bootstrap.min.css" rel="stylesheet">

   
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	
	<style type="text/css">
		body {
			margin-top: 20px;
		}
		.stripe-button-el{display:none!important;}
		.btn-pay{
			background-color:#<?php echo $button_color;?>;
			border-color:#<?php echo $button_border_color;?>;
		}
		.btn-pay:hover{
			background-color:#<?php echo $button_hover_color;?>!important;
		}
		.navbar-inverse{
			background-color:#<?php echo $header_color;?>!important;
		}
	</style>
</head>

<body>

<?php if(empty($tokenid)):?>
<div class="container well">
	<div class="row navbar-inverse" style="margin: -20px -20px 20px -20px; padding: 20px;">
			  <div clas="col-xs-6 col-sm-6 col-md-6">
				<img src="../ls/<?php echo $site_logo?>" width="123" height="32">
			  </div>
	</div>
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">			
                <div class="col-xs-6 col-sm-6 col-md-6">
					<span class="text-danger">Invalid Token ID</span>
				</div>
			</div>
		</div>
	</div>
</div>	
<?php else:?>

<?php if($has_submitted==1):?>
<div class="container well">
<div class="row navbar-inverse" style="margin: -20px -20px 20px -20px; padding: 20px;">
			  <div clas="col-xs-6 col-sm-6 col-md-6">
				<img src="../ls/<?php echo $site_logo?>" width="123" height="32">
			  </div>
			</div>
	<div class="row">
		<div class="col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
		<?php if(!is_null($charge)):?>				
			<h1 class="h1 text-success">Successfully charged...</h1>			
		<?php endif;?>			
		</div>
	</div>	
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
           <?php  echo '<strong>Token Id From form.php:</strong> ', $tokenid;?>
        </div>
    </div>	
	<?php if(!is_null($charge)):
	
		$tokenidResults = mysql_query("SELECT * FROM questionnaire WHERE token = '".$tokenid."' order by id desc limit 1;");
      
	    while($row = mysql_fetch_array($tokenidResults))
		{
			$name = $row['name'];
			$phone = $row['phone'];
			$email = $row['email'];
			$aff_id = $row['aff_id'];
			$click_hash = $row['clcik_hash'];
			$tokenid = $row['token'];
			//$has_submitted = $row['has_submitted'];
			$units_sold = $row['units_sold'];
		}
	
	?>		
	
	<div class="row">
        <div class="col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
			<h1 class="h1">Database Values:</h1>
			<p>
				<strong>Name: </strong> <?php echo $name;?>
			</p>
			<p>
				<strong>Phone: </strong> <?php echo $phone;?>
			</p>
			<p>
				<strong>Email: </strong> <?php echo $email;?>
			</p>
			<p>
				<strong>Affiliate ID: </strong> <?php echo $aff_id;?>
			</p>
			<p>
				<strong>Click Hash: </strong> <?php echo $click_hash;?>
			</p>
			<p>
				<strong>Token Id: </strong> <?php echo $tokenid;?>
			</p>			
		</div>
	</div>	
	<?php endif;?>
	<div class="row">
		<div class="col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
		<?php if(!is_null($charge)):?>				
			<h1 class="h1">Stripe charge response object:</h1>
			<p>
				<?php print_r($charge);?>
			</p>
		<?php endif;?>	
					
		</div>
	</div>		
</div>
<?php else:?>
<div class="container well">
<div class="row navbar-inverse" style="margin: -20px -20px 20px -20px; padding: 20px;">
			  <div clas="col-xs-6 col-sm-6 col-md-6">
				<img src="../ls/<?php echo $site_logo?>" width="123" height="32">
			  </div>
			</div>
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">		   
           <span class="text-warning">Are you kidding?</span>
        </div>
    </div>
</div>	
<?php endif;?><!--has_submitted-->
<?php endif;?>
</body>
</html>