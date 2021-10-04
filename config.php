<?php
require_once('stripe/vendor/autoload.php');
require_once('conn.php'); 
//require_once('ls/application/config/database.php');
$secret_key ='';
$publishable_key = '';
$twilio_sid = '';
$twilio_auth_token = '';


$row  = $db->getOne("app_keys");

if(!empty($row))
{
	$secret_key = $row['stripe_secret_key'];
	$publishable_key = $row['stripe_publishable_key'];
	$twilio_sid = $row['twilio_sid'];
	$twilio_auth_token = $row['twilio_auth_token'];
}
// while($row = mysql_fetch_array($app_query))
// {
	// $secret_key = $row['stripe_secret_key'];
	// $publishable_key = $row['stripe_publishable_key'];
	// $twilio_sid = $row['twilio_sid'];
	// $twilio_auth_token = $row['twilio_auth_token'];
// }

/*
$stripe = array(
  "secret_key"      => "sk_test_aMyil0B0kH52lBo66U7iy7p3",
  "publishable_key" => "pk_test_3phm3nd1RlD1I1EKryaRQFoo"
);
*/
$stripe = array(
  "secret_key"      => $secret_key,
  "publishable_key" => $publishable_key
);

/*
$sid = 'AC81d677b40f25864456091d1633af226e';
$token = '796e83917963d8733aa29fc3a272a12c';
*/
$sid = $twilio_sid;
$token = $twilio_auth_token;

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>