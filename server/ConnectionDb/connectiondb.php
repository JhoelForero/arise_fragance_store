<?php
class connectionDb{
    /**
     * This is where the connection with database is established. create methods for add, remove, edit, get data from database.
     * Only call this class when verifications in application were successful.
     */


    /* -- Note -- 
    I'm confident that this is wrong. I'm still working to understand how the architecture is meant to look
    */
    static $connection;
    static $servername;
    static $username;
    static $password;
    static $dbname;

    static $statement;

    
    static function initConnection()
    {
        $connection = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($connection->connect_error) {
        die("Connection failed: " . $conn->connect_error);


        // Prepare and bind (to prevent SQL injection)
        $statement = $conn->prepare("INSERT INTO your_table (name, email) VALUES (?, ?)");
        $statement->bind_param("ss", $name, $email); // "ss" indicates two string parameters
    }



    /* -- Additional Code for Later -- 
    // Set parameters and execute
    $name = "John Doe";
    $email = "john.doe@example.com";
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    */

}
?>