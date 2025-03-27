<?php

/*
-- NOTE --  
	Registration through a form seems to want to redirect.
	I'm going to leave my json response infrastructure here for now,
	in case Nabila want's to manually handle the response

	QUESTION: How should I return failed registration so the user doesn't
			  get shunted around?


Returns JSON 
	true  --> Registration successul
	false --> Registration failed
	Error String --> specific to error
*/

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = isset($_POST["username"]) ? $_POST["username"] : null;
	$password = isset($_POST["password"]) ? $_POST["password"] : null;
	$fullName = isset($_POST["fullname"]) ? $_POST["fullname"] : null;
	$email 	  = isset($_POST["email"])    ? $_POST["email"]    : null;

	
	// -- Error Checking with Verbose Errors -- //
	$errorStr = "";
	if ($username === null || $username === "")
	{
		$errorStr .= "username";
	}
	if ($password === null || $password === "") {
		$errorStr .= ", password ";
	}
	if ($fullName === null || $fullName === "") {
		$errorStr .= ", fullname ";
	}
	if ($email === null || $email === "") {
		$errorStr .= ", email ";
	}
	if ($errorStr !== "")
	{
		header("Content-Type: application/json");
		// echo json_encode("Error: failed to define: " . $errorStr);
		die();
	}

	// ---- ---- Querying ---- ---- //
	require_once "db.php";

	// -- Does this user already exist? -- //
	$query = "SELECT * FROM users where username = ?;";
	$stmt  = $pdo->prepare($query);
	$stmt->execute([$username]);
	$user = $stmt->fetch();

	if ($user !== false) // User with this username already exists
	{
		header("Location: ../frontend/index.html");
		//echo json_encode(false); // DONT TOUCH
		$pdo = null;
		die();
	}

	// -- Try insert Query -- //
	try{
		$query = "INSERT INTO users (username, password, fullName, email) VALUES (?, ?, ?, ?);";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$username, $password, $fullName, $email]);
		header("Location: ../frontend/index.html");	
		//echo json_encode(true); // DONT TOUCH

		// -- Freeing resources -- //
		$pdo = null;
		die();
	} catch (PDOException $e) {
		echo json_encode($e->getMessage());
		die();
	}
}

echo json_encode("Error: incorrect request method. Use Post");
die();
?>







