<?php

require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
        $id = $_GET['id'];

        if ($id)
        {
                $query = "SELECT * FROM products WHERE productId = ?;";
                $stmt  = $pdo->prepare($query);
                $stmt->execute([$id]);
                $product = $stmt->fetch();

                if ($product)
                {
                        echo json_encode($product);
                        die();
                }
                else 
                {
                        header("../frontend/index.html");
                        die();
                }
        } else {
                header("../frontend/index.html");
                die();
        }
}

?>