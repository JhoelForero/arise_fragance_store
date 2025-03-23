<?php
/*
Expects
	{
		username: <username>
		password: <password>
	}
*/


$method = $_SERVER['REQUEST_METHOD'];								// returns value of 'request_method'
$body = json_decode(file_get_contents('php://input'), true);		// read-only stream that allows you to read raw data from the request body


$outStr = $method . "\n";
$outStr = $outStr . $body['username'] . "\n";
$outStr = $outStr . $body['password'] . "\n"; 



/*
TODO: Create connection with db and attempt login
*/


//json_encode();

echo $outStr;
?>