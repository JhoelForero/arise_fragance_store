<?php
header('Content-Type: application/json');
session_start();

if (isset($_SESSION['userId']) && $_SESSION['userId']){
	http_response_code(300);
	echo json_encode([
	'redirect' => true
	]);
	exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	// $body = json_decode(file_get_contents('php://input'), true);		// read-only stream that allows you to read raw data from the request body

	$input = json_decode(file_get_contents('php://input'), true);
	require_once "db.php";
	try {
		if (empty($input['email'])) throw new Exception('Email is required', 400);
		if (empty($input['password'])) throw new Exception('Password is required', 400);

		$email = filter_var(trim($input['email']), FILTER_SANITIZE_EMAIL);
		$password = trim($input['password']);

			// create db connection

		$query = "SELECT userId, email, password FROM users WHERE :email = email";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($user && password_verify($password, $user['password'])) {
			$_SESSION['userId'] = $user['userId'];
			http_response_code(201);
			echo json_encode([
			'success' => true
			]);
			// -- Freeing resources -- //
			$pdo = null;
			exit();
		}
		else{
			throw new PDOException('The provided email or password is incorrect. Please try again.',500);
		}
	} catch (PDOException $e) {
		http_response_code($e->getCode() ?: 500);
			echo json_encode([
			'success' => false,
			'error' => [
				'type' => 'invalid_request',
				'message'=> $e->getMessage()
			]
			]);
			// -- Freeing resources -- //
			$pdo = null;
		exit();
	}
	catch (Exception $e) {
		http_response_code($e->getCode() ?:$e->getCode() ?:500);
		echo json_encode([
		'success' => false,
		'error' => [
			'type' => 'Unknown_exception',
			'message'=> $e->getMessage()
		]
		]);
	}

} else {
	http_response_code(400);
	echo json_encode([
		'success' => false,
		'error' => [
			'type' => 'Bad Request',
			'message' => 'Request Should be made as POST'
		]
	]);
}
?>