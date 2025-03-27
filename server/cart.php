
<?php




/* -- TODO --
 The get request. Make sure it gets all values associated with a given ID 
*/

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $userId    = isset($_POST['userId'])    ? $_POST['userId']    : null;
    $productId = isset($_POST['productId']) ? $_POST['productId'] : null;

    $errorStr = "";
    if ($userId === null || $userId === "") {
        $errorStr .= "userId";
    }
    if ($productId === null || $productId === "") {
        $errorStr .= ", productId ";
    }
    if ($errorStr !== "") {
        header("Content-Type: application/json");
        http_response_code(400); // Bad Request
        echo json_encode("Error: Missing parameters: " . $errorStr);
        die();
    }

    // -- NOTE: This procedure can be done in a single Query -- //

    try{
        require_once "db.php";
        // -- Verifying Product Exists -- //
        $query = "SELECT * FROM users WHERE userId = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false)
        {
            //echo json_encode(`Warning: failed to add product:${productId} to User: ${userId}'s cart`);
            echo json_encode(`Error: no user with ID: ${userId} exists`);
            $pdo = null;
            die();
        }
        $result === null;

        // -- Verify User Exists -- //
        $query = "SELECT * FROM products WHERE productId = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$productId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false)
        {
            //echo json_encode(`Warning: failed to add product:${productId} to User: ${userId}'s cart`);
            echo json_encode(`Error: no product with ID: ${productId} exists`);
            $pdo = null;
            die();
        }
        $result = false;


        // -- Creating new cart entry -- //
        $query = "INSERT INTO shopping_cart (productId, userId)
                      VALUES (?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$productId, $userId]);
        if ($stmt->rowCount() == 0)
        {
            echo json_encode("Warning: server failed to add cart item to database");
            $pdo = null;
            die();
        }
        $pdo = null;


        echo json_encode(true);
        die();

    } catch (PDOException $e)
    {
        echo json_encode($e->getMessage());
        die();
    }    
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once "db.php";
    // -- Verifying Product Exists -- //
    /*
    $slctQuery = "SELECT * FROM shopping_cart WHERE userId = ? AND productId = ?;";
    $selectStmt = $pdo->prepare($slctQuery);
    $selectStmt->execute([$userId, $productId]);
    $product = $selectStmt->fetch(PDO::FETCH_ASSOC);
    if ($product === false)
    {
        //echo json_encode(`Warning: failed to add product:${productId} to User: ${userId}'s cart`);
        echo json_encode(`Warning: no product with ID: ${productId} exists`);
        $pdo = null;
        die();
    }
    */
    echo "oops";
    die();
}

echo json_encode("Error: POST \ GET not used");
?>