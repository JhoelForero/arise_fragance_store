<?php

require_once "db.php";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST["username"];
	$password = $_POST["password"];
	$fullName = $_POST["fullname"];
	$email    = $_POST["email"];


	// -- Checking -- //
	// TODO: check for duplicate usernames
	$query = "SELECT * FROM users where username = ?;";
	$stmt  = $pdo->prepare($query);
	$user = $stmt->execute([$username]);

	if ($user)
	{
		header("Location: ../frontend/index.html");
	}

	try{

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
	header("Location: ../frontend/index.html");
	echo "Error: bad registration";
}


?>







