<?php

    require_once "db.php";

    if ($_SERVER['REQUEST_METHOD'] == "GET")
    {

        // TODO: Get query string values for list of products
        $startIdx = $_GET['startIdx'];
        $endIdx   = $_GET['endIdx'];

        /*
        $response = array(
            'startIdx' => $_GET['startIdx'],
            'endIdx'   => $_GET['endIdx']
        );
        */

        if ($startIdx && $endIdx)
        {
            // TODO: Query database
            $qry = "
                WITH NumberedProducts AS
                (
                    SELECT
                        productId,
                        productName,
                        productDescription,
                        productPrice,
                        GENDER,
                        BRAND,
                        ROW_NUMBER() OVER (ORDER BY productId) AS RowNumber
                    FROM
                        products
                )
                SELECT
                    productId,
                    productName,
                    productDescription,
                    productPrice,
                    GENDER,
                    BRAND
                FROM
                    NumberedProducts
                WHERE
                    RowNumber BETWEEN ? AND ? 
                    -- TEST VALUES
            ";

            $stmt = $pdo->prepare($qry);
            $stmt->execute([$startIdx, $endIdx]);
            $products = $stmt->fetchAll();

            header("Content-Type: application/json");
            echo json_encode($products);
            die();
        }
    }
?>