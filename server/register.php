<?php
header('Content-Type: application/json');

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$input = json_decode(file_get_contents('php://input'), true);

	try {
		if (empty($input['name'])) throw new Exception('Name is required', 400);
		if (empty($input['email'])) throw new Exception('Email is required', 400);
		if (empty($input['password'])) throw new Exception('Password is required', 400);
		if (empty($input['passwordTwo'])) throw new Exception('Password confirmation is required', 400);

		$name = trim($input['name']);
		$email = filter_var(trim($input['email']), FILTER_SANITIZE_EMAIL);
		$password = trim($input['password']);
		$password2 = trim($input['passwordTwo']);
		//VERIFICATION 1: EMAIL VALID
		verifyEmail($email);

		//VERIFICATION 2: PASSWORD VALID
		verifyPassword($password);

		//VERIFICATION 3: PASSWORD 2 = PASSWORD 1
		verifyPassword2($password, $password2);

		//VERIFICATION 4: USER NOT EXISTS
		verifyUserNotExist($email);

		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		$query = "INSERT INTO users (email, password, username) VALUES (:email, :password, :username);";

		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);
		$stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
		$stmt->bindValue(':username', $name, PDO::PARAM_STR);
		$stmt->execute();
		http_response_code(201);
		echo json_encode([
			'success' => true
		]);
		// -- Freeing resources -- //
		$pdo = null;
		exit();

	} catch (InvalidArgumentException $e) {
		http_response_code($e->getCode() ?: 400);
		echo json_encode([
			'success' => false,
			'error' => [
				'type' => 'invalid_request',
				'message' => $e->getMessage()
			]
		]);
	} catch (PDOException $e) {
		http_response_code($e->getCode() ?: 500);
		echo json_encode([
			'success' => false,
			'error' => [
				'type' => 'database_error',
				'message' => $e->getMessage()
			]
		]);
	} catch (Exception $e) {
		http_response_code($e->getCode() ?: 500);
		echo json_encode([
			'success' => false,
			'error' => [
				'type' => 'general_error',
				'message' => $e->getMessage()
			]
		]);
	}
}
 else {
	http_response_code(400);
	echo json_encode([
		'success' => false,
		'error' => [
			'type' => 'Bad Request',
			'message' => 'Request Should be made as POST'
		]
	]);
}


function verifyEmail($email) {
	$patternForEmail = '/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})$/i';
	$isRightPattern = preg_match($patternForEmail, $email);
	if (!$isRightPattern) {
		throw new InvalidArgumentException(
			'Invalid email address: Please ensure you have entered a valid email format.', 400);
	}
}

function verifyPassword($password) {
	$patternForPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
	$isRightPassword = preg_match($patternForPassword, $password);
	if (!$isRightPassword) {
		throw new InvalidArgumentException(
			'Invalid Password format: Please use at least 8 characters, at least 1 Uppercase and 1 Lowercase and 1 number',400);
	}
}

function verifyPassword2($password, $password2) {
	$paswordMatch = $password === $password2;
	if (!$paswordMatch) {
		throw new InvalidArgumentException(
			'Invalid password format: Both passwords must match to proceed with registration',400);
	}
}

function verifyUserNotExist($email){
	global $pdo;
	$verificationUserQuery = "SELECT COUNT(*) FROM users WHERE email = :email;";
	$verificationUser  = $pdo->prepare($verificationUserQuery);
	$verificationUser->bindValue(':email', $email, PDO::PARAM_STR);
	$verificationUser->execute();
	$user = (int)$verificationUser->fetchColumn();
    $userExists = $user != 0;
	if ($userExists) {
		throw new PDOException(
			'Internal Server Exception: Email is already registered.',500);
	}
}

?>







