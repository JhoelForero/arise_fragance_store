<?php



/*
Returns JSON 
	JSON Object  --> Found product 
	false        --> Failed to find product
	Error String --> specific to error
*/

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] = 'GET')
{
    $product_name = isset($_GET['name']) ? $_GET['name'] : null;

    if ($product_name === null) 
    {
        echo json_encode("Error: failed to specify product name");
        die();
    }

    require_once "db.php";

    $query = "SELECT * FROM products WHERE productName = ?;";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$product_name]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as an associative array
    $pdo = null;

    if ($result)
    {
        echo json_encode($result);
        die();
    } else {
        echo json_encode(false);
        die();
    }
}

echo json_encode("Error: incorrect method. Use GET");
?>