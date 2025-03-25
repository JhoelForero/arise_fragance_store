<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST["username"];
	$password = $_POST["password"];
	$fullName = $_POST["fullname"];
	$email    = $_POST["email"];


	// -- Checking -- //
	// TODO: check for duplicate usernames

	try{
		require_once "db.php";

		$query = "INSERT INTO users (username, password, fullName, email) VALUES (?, ?, ?, ?);";

		$stmt = $pdo->prepare($query);

		$stmt->execute([$username, $password, $fullName, $email]);

		// -- Freeing resources -- //
		$pdo = null;
		$pdo = null;

		die();
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
} else {
	// TODO: return to index
	// header("Location: ../index.php")
	echo "Error: bad registration";
}


?>







