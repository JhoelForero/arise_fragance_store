<?php


header("Content-type: application/json");


// include 'db.php'; TODO


$method = $_SERVER['REQUEST_METHOD'];								// returns value of 'request_method'
$resource = isset($_GET['resource']) ? $_GET['resource'] : null;	// returns value of 'resource'. 
$input = json_decode(file_get_contents('php://input'), true);		// read-only stream that allows you to read raw data from the request body



/*
	POST for info you want better security for
	GET for all other resources

	Our API needs to be designed intentionally. Don't try for a solution that
	can handle variation in the API design.
*/






switch ($method) {
	case 'GET':
		handleGet($resource);
		break;
	case 'POST':
		handlePost($input, $resource);
		break;
	case 'PUT':
		handlePut($input, $resource);
		break;
	case 'DELETE':
		handleDelete($input, $resource);
		break;
	default:
		echo json_encode(['message' => 'Invalid request method']);
		break;
}







function handleGet($resource)
{

	switch ($resource) 
	{
		case 'fragrances':
		{

			echo 'get fragrances';
			break;
		}
	}



	$sql = "SELECT * FROM users";
	//$stmt = $pdo->prepare($sql); 
	//$stmt->execute();
	//$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//echo json_encode($result);

	// -- Testing Handle Get -- //
}



function handlePost($input, $resource)	//dbc
{
	// -- Testing Handle Post -- //

	switch ($resource)
	{
		case 'login':
			echo 'login';
			break;
		case 'logout':
			echo 'logout';
			break;
		case 'register':
			break;
		default:
			echo json_encode(['message' => ('Invalid resource: '.$resource)]);
			break;
	}//~switch
	http_response_code(200);
}//~handlePost



function handlePut($input, $resource) //dbc
{}

function handleDelete($input, $resource)	//dbc
{}








/*
I don't think I need this tbh
*/
function getResourcePath() 
{
	// 1. Get the requested URL
    $requestUri = $_SERVER['REQUEST_URI'];

	// 2. Remove the query string (if any)
    $queryStringPosition = strpos($requestUri, '?');
    if ($queryStringPosition !== false) {
        $requestUri = substr($requestUri, 0, $queryStringPosition);
    }

    // 3. Remove the base path of the script (if it's in a subdirectory)
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $basePath = dirname($scriptName);

    if (strpos($requestUri, $basePath) === 0) {
        $requestUri = substr($requestUri, strlen($basePath));
    }

    // 4. Remove leading and trailing slashes
    $resourcePath = trim($requestUri, '/');

    // 5. Split the path into segments
    $pathSegments = explode('/', $resourcePath);

    return $pathSegments;
}


?>






