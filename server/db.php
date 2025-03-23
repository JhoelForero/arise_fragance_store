<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$dbname = "users";

	try {
		// What is PDO?
		$pdo = new PDO("mysql:host=$host;dbname$dbname", $user, $password);
	} catch (PDOException $e) {
		die ("Connection failed: " . $e->getMessage());
	}
?>