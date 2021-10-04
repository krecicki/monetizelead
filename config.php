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
$stripe = array(
  "secret_key"      => $secret_key,
  "publishable_key" => $publishable_key
);

$sid = $twilio_sid;
$token = $twilio_auth_token;

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>