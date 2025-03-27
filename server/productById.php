<?php

/*
Returns JSON 
	JSON Object  --> Found product 
	false        --> Failed to find product
	Error String --> specific to error
*/

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($id === null)
        {
                echo json_encode("Error: failed to pass product id");
                die();
        }

        require_once "db.php";

        $query = "SELECT * FROM products WHERE productId = ?;";
        $stmt  = $pdo->prepare($query);
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as an associative array
        $pdo = null;

        if ($product)
        {
                echo json_encode($product);
                die();
        }
        else 
        {
                echo json_encode(false);
                die();
        }
}

echo json_encode("Error: failed to specify product ID");
?>