<?php require_once('../config.php'); ?>
<?php 
// Get unique tokenid generated on original lead form submit that was inserted in the DB in the leads row
$tokenid = $_GET['tokenid'];
$phone_no = $_GET['ntoken'];

function format_interval(DateInterval $interval) {
    $result = "";
    if ($interval->y) { $result .= $interval->format("%y years "); }
    if ($interval->m) { $result .= $interval->format("%m months "); }
    if ($interval->d) { $result .= $interval->format("%d days "); }
    if ($interval->h) { $result .= $interval->format("%h hours "); }
    if ($interval->i) { $result .= $interval->format("%i minutes "); }
    if ($interval->s) { $result .= $interval->format("%s seconds "); }

    return $result;
}

function get_time_since_last_unit_sold($token)
{
	global $db;
	$row = $db->where('token',$token)
			  ->orderBy('purchased_timestamp','DESC')
			  ->getOne('customer_purchases');
	$timestamp = 0;
	
	if(!empty($row))
	{		
		$timestamp = $row['purchased_timestamp'];  			
	}   	
	if($timestamp==0)
		return "0";
	else
		return get_lead_age($timestamp);
}

function get_lead_age($timestamp)
{	

	$first_date = new DateTime();
	$first_date->setTimestamp($timestamp);

	$current_time = time();

	$second_date = new DateTime();
	$second_date->setTimestamp($current_time);

	$difference = $first_date->diff($second_date);
		
	return format_interval($difference);
}
$row = $db->where('token',$tokenid)
		  ->orderBy('id','DESC')
		  ->getOne('questionnaire');

$units_sold =0;
$timestamp = 0;
if(!empty($row))
{
	$units_sold = $row['units_sold'];
	$timestamp = $row['timestamp'];  			
}

$row = $db->getOne('custom_settings');
if(!empty($row))
{
	$button_color = $row['button_color'];
	$button_hover_color = $row['button_hover_color'];
	$button_border_color = $row['button_border_color'];
	$header_color = $row['header_color'];
}	

$settings = $db->getOne('site_settings');
$site_logo = $settings['upload_path_relative'].'/'. $settings['site_logo'];

//get user object on the basis of phone_no

$user= $db
		->where('phone_no',base64_decode($phone_no))
		->getOne('users');

$tags = '';
$aggregated_cost = 0;

$user_lead_types = $db
					->where('user_id',$user['ID'])					
					->get('user_lead_types');	
foreach($user_lead_types as $lead_type)
{
	//get cost of each lead type
	$l = $db->where('id',$lead_type['lead_type_id'])->getOne('lead_types');//
	$aggregated_cost = $aggregated_cost + doubleval($l['cost']);
}					
	$btnCost = ($aggregated_cost*100);
			
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Choice Insurance::Payment</title>

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

<div class="container">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
			<div class="row navbar-inverse" style="margin: -20px -20px 20px -20px; padding: 20px;">
			  <div clas="col-xs-6 col-sm-6 col-md-6">
				<img src="../ls/<?php echo $site_logo?>" width="123" height="32">
			  </div>
			</div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <p>
                        <strong>Time since last unit sold</strong>
                        <br>
                        <span  class="text-muted"><?php echo get_time_since_last_unit_sold($tokenid);?></span>
					<p>
                    <p>
                        <strong>Age of this Lead</strong>
                        <br>
                        <span  class="text-muted"><?php echo get_lead_age($timestamp);?></span>
                    </p>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p class="text-success">
                        <strong><em>Units Sold:</strong></em> <?php echo $units_sold;?>
                    </p>      
					<p>
						<strong>Lead Cost(aggregated)</strong>
						<br>
						<span class="text-muted"><?php echo $aggregated_cost;?></span>
					</p>
                </div>
            </div>
            <div class="row">   
				<form action="charge.php" method="post">
					<input type="hidden" name="token" value="<?php echo $tokenid?>"/>
					<input type="hidden" name="ntoken" value="<?php echo $phone_no?>"/>				
				    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
					  data-key="<?php echo $stripe['publishable_key']; ?>"
					  data-amount="<?php echo $btnCost ?>" data-description="Lead Checkout"></script>
				    <button type="submit" class="btn btn-success btn-lg btn-block btn-pay">
							Pay Now   <span class="glyphicon glyphicon-chevron-right"></span>
					</button>
					<input type="hidden" value="<?php echo mt_rand( 0, 0x2Aff );?>" name="nonce"/>
				</form>               
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="design/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="design/js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('.stripe-button-el').addClass('btn btn-success btn-lg btn-block');
		
	});
</script>

</body>
</html>
