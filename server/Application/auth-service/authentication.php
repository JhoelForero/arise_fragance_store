<?php
require_once __DIR__ . '/../application.php';
class authentication extends application
{
    //subclass for authentication requests: login, register, logout.
	
	
	
	/*
	* Validates new user using credentials passed
	* This should also be done in the front end, to avoid
	* unnecassary processing, but the backend must still validate
	*/
	static function validateNewUser($username, $password)
	{	
	
		/* -- TODO --
			> Consider exception handling so outcome can be better communicated
			> sanity check on username and password to make sure they're not
			  trying to break our database
		*/
		
		// TODO: Does username already exist?
		
		//-- Proper length
		if (strlen($username) < MIN_LENGTH)
		{
			
			return false;
		}
		if (strlen($password) < MIN_LENGTH)
		{
			return false;
		}
		
	
		//-- Password has 1 letter, number, special character?
		$bHasSpecialCharacter = false;
		for ($i = 0; $i < strlen($password); $i++)
		{
			if (strpos(SPECIAL_CHARACTERS, $password[$i]) !== false)
			{
				$bHasSpecialCharacter = true;
				break;
			}
		}
		if ($bHasSpecialCharacter !== true) {return false;}
	}//~validateNewUser



	
	// A function to create a new user. 
	static function registerNewUser($username, $password)
	{
		if (validateNewUser($username, $password)) {return false;}
		
		// TODO: Communicate with DB to create new user
			
		return true;
	}//~registerNewUser
	


	
	/* TODO */
	static function login($username, $password)
	{
		//if (successful) return true;
		//else return false;
	}
	


	/* TODO */
	static function logout($username, $password)
	{
		
	}
	

}
?>