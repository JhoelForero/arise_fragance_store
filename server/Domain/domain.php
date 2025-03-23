<?php
abstract class domain 
{
    /**
     * In this section you put all the business rules, constants and methods that will be used in the application.
     * For example, all minimum characters for login, passwords constraints, etc. will be saved here are taken by application class.
     */

    /* -- QUESTIONS --
    * 1. If certain properties like MIN_LENGTH are only used for authentication, shouldn't they be only in that file?
    */

	// Min Characters for legal password & username
	const MIN_LENGTH = 8;
    // List of special characters used for validating user signups
	const SPECIAL_CHARACTERS = "!@#$%^&*()_+=-[]{}|;':\",./<>?";

}
?>