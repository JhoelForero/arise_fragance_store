<?php
/*
Expects
	{
		username: <username>
		password: <password>
	}
*/



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	// $body = json_decode(file_get_contents('php://input'), true);		// read-only stream that allows you to read raw data from the request body

	$username = $_POST["username"];
	$password = $_POST["password"];
	
	try {
		require_once "db.php";	// create db connection

		$query = "SELECT * FROM users WHERE username = ?"; // ''??
		$stmt = $pdo->prepare($query);

		$stmt->execute([$username]);
		
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($user)
		{
			$str = "";
			if ($user['loggedIn'])
			{
				echo "logged in";
			} else {
				$query = "UPDATE users set loggedIn = 1 where username = $username";
				$stmt = $pdo->prepare($query);
				$stmt->execute([$username]);
			}
		}
		

		

		// -- Freeing up resources -- //
		$pdo = null;
		$stmt = null;

		// header("Location: ../index.php"); // Send user to front page

		die();
	} catch (PDOException $e) {
		echo $e->getMessage();
		// header("Location: ../index.php");
	}

	//json_encode();

	echo $outStr;

} else {
	// TODO: return to index
	//header("Location: ../index.php"); // If user tries to get here without sending the form
}
?>