<?php
/*
+ ----------------------------------------------------------------------------+
|     MuSeSPinger
|     Status Checker
|
|     ZAPPERPOST
|     http://www.deltik.org/
|     zapperpost@gmail.com
|
|     Last Modified: 2008/11/27
+----------------------------------------------------------------------------+
*/
	// Configuration is always required
	require('config.php');
	
	// Process the data and determine the port
	$data = $_REQUEST['data'].":";
	$data2 = str_replace("::", ":", $data);
	list($url,$port) = explode (':',$data2);
	
	// If the port is empty, use 80
	if (empty($port)){
		$port = 80;
	}

	// Take out the trailing slash
	if(strstr($url,"/")){
		$url = substr($url, 0, strpos($url, "/"));
	}

	// Test the server
	$status = @fsockopen($url, $port, $errno, $errstr, 8);
	
	if ($_REQUEST['reason'] == TRUE){
	die("$errstr ($errno)");
	}
	
	// Get the proper image
	if (!$status){
		header("Location: ".$offline);
	} else {
		header("Location: ".$online);
		fclose($status);
	}

	?>
