<?php


// Min Characters for legal password & username
const MIN_LENGTH = 8;



/* -- Expects --
{
	username: ___,
	password: ___
}
*/
$method = $_SERVER['REQUEST_METHOD'];					 
$body   = json_decode(file_get_contents('php://input'), true); // get contents of body as json object


if ($method != 'POST')
{
	echo 'Bad request. Wrong method';
}


$username = $body['username'];
$password = $body['password'];

echo "Register: " . $username . " " . $password;
die();

// -- Does Username already exist? -- //
// TODO: query db



// ---- Are username & password valid? ---- //
// -- Proper length
if (strlen($username) < MIN_LENGTH)
{
	return false;
}
if (strlen($password) < MIN_LENGTH)
{
	return false;
}
		


	
//-- Password has 1 letter, number, special character?

/*$bHasSpecialCharacter = false;
for ($i = 0; $i < strlen($password); $i++)
{
	if (strpos(SPECIAL_CHARACTERS, $password[$i]) !== false)
	{
		$bHasSpecialCharacter = true;
		break;
	}
}
if ($bHasSpecialCharacter !== true) {return false;}
*/


?>







