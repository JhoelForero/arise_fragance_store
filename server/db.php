<?php

	$db_user = "root";
	$db_password = "HSYpyn95";
	$dbname = "assignment2_web";

	try {
		$pdo = new PDO("mysql:host=localhost;dbname=$dbname", $db_user, $db_password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // If we get an error, throw an exception
	} catch (PDOException $e) {
		die ("Connection failed: " . $e->getMessage());
	}
	
?>