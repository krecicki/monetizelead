<?php
require_once 'ChoiceAPI.php';
// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
	 
	 if(array_key_exists('request',$_REQUEST) && array_key_exists('HTTP_ORIGIN', $_SERVER))
	 {
		$API = new ChoiceAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
		echo $API->processAPI();	
	 }
	 else
		 echo json_encode(Array('error'=>'An unexpected error occured.', 'request'=>$_REQUEST, 'server'=>$_SERVER));
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
?>