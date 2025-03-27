<?php



header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == "GET")
{
    $startIdx = isset($_GET['startIdx']) ? $_GET['startIdx'] : null;
    $endIdx   = isset($_GET['endIdx'])   ? $_GET['endIdx']   : null;

    if ($startIdx === null || $endIdx === null)
    {
        echo json_encode("Error: failed to specify indices");
        die();
    }

    try {
        require_once "db.php";

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
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Object.keys(data.shareInfo[i]).length 
        $pdo = null;

        echo json_encode($products);
        die();
    } catch (PDOException $e)
    {
        echo $e->json_encode($e->getMessage());
        die();
    }
} 

echo json_encode("Error: Incorrect method: use GET");
?>