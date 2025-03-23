<?php
class apiconnection{
    /**
     * This is the general connection with client. all request will be handled here. 
     * This class is responsible for both call application class and connectionDb classes. 
     * ex: in a sign up request, if all validation from application class is correct, call connectionDb and send client data to there.


    QUESTION:
        I'm having trouble understanding the intended use for this class. The front end helps use decide which pages and systems the user can access.
        What is the purpose of a control class like this one?


    NOTE: 
        option 1) The athentication class has no connection to db. This means we must either store user data in RAM, and somehow pass this data when
                  auth,login,logout etc, to those auth methods
        option 2) The connectiondb is itself an API for the db, wich any of the classes in our program can make calls to.
                  This option is logically different than what I perceive the comment above to be suggesting
        - Arthur
     */
	 
	 
	/*
	Do static classes get instantied while XAMPP is running? If not, we're creating a new db connection each time we query, anyway
	*/
	
	
	authetnication(conection);
	dbconection;
	dbonnection.add
	
	dbconnection.sqlQuery("...");
}
?>