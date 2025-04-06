<?php
header('Content-Type: application/json');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    //Functionality to get name for headers in frontend
    if (isset($_GET["isLogged"])){
        try{
            if (!empty($_GET["isLogged"])) throw new Exception('No values required for this request', 400);
            if(isset($_SESSION["userId"])){
                http_response_code(200);
                    echo json_encode([
                    'isLogged' => true
                    ]);
                exit();
            }
            else{
                http_response_code(200);
                echo json_encode([
                'isLogged' => false
                ]);
                exit();
            }
        }catch(Exception $e){
            http_response_code($e->getCode() ?:500);
            echo json_encode([
            'error' => [
                'type' => 'invalid_request',
                'message' => $e->getMessage()
            ]
            ]);
            exit();
        }
    }

    if (isset($_GET["getName"])) {
        if(isset($_SESSION['userId'])){
            try {
                if (!empty($_GET["getName"])) throw new Exception('No values required for this request', 400);
                require_once "db.php";
                $query = "SELECT username FROM users WHERE userId = :userId";
                $stmt = $pdo->prepare($query);
                $stmt->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                http_response_code(200);
			    echo json_encode([
			    'isLogged' => true,
                'username' => $result[0]['username']
			    ]);
			    // -- Freeing resources -- //
			    $pdo = null;
			    exit();
            } catch (Exception $e) {
                http_response_code($e->getCode() ?:500);
                echo json_encode([
                'error' => [
                    'type' => 'invalid_request',
                    'message' => $e->getMessage()
                ]
                ]);
			    $pdo = null;
			    exit();
            }
        }
        else{
            http_response_code(200);
			echo json_encode([
			'isLogged' => false
			]);
			// -- Freeing resources -- //
			$pdo = null;
			exit();
        }

    }
    //functionality to logout in frontend button
    if (isset($_GET["logout"])) {
        if(isset($_SESSION["userId"])){
            try {
                if (!empty($_GET["logout"])) throw new Exception('No values required for this request', 400);
                session_destroy();
                http_response_code(201);
			    echo json_encode([
			        'isNotLogged' => true,
			    ]);
                exit();
            }
            catch (Exception $e) {
                http_response_code($e->getCode() ?:500);
                echo json_encode([
                    'isNotLogged' => false,
                    'error' => $e->getMessage()
                ]);
			    $pdo = null;
			    exit();
            }
        }
    }
    //Functionality to add item to cart on click of button
    if (isset($_GET["addCart"])) {
        try{
            if (empty($_GET["addCart"])) throw new Exception('Include itemId on request', 400);
            if (!isset($_SESSION['userId'])) throw new Exception('user not logged in', 500);
            require_once "db.php";
            $cartItemId = $_GET["addCart"];
            $query = "INSERT INTO shopping_cart (productId, userId) VALUES (:productId, :userId);";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':productId', $cartItemId, PDO::PARAM_INT);
            $stmt->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_INT);
            $stmt->execute();
            http_response_code(201);
            echo json_encode([
                'success' => true
            ]);
            // -- Freeing resources -- //
            $pdo = null;
            exit();

        }
        catch (Exception $e) {
            http_response_code($e->getCode() ?:500);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
            $pdo = null;
            exit();
        }
    }

    if (isset($_GET["removeCart"])) {
        try {
            if (empty($_GET["removeCart"])) throw new Exception('Include itemId on request', 400);
            if (!isset($_SESSION['userId'])) throw new Exception('User not logged in', 500);
            require_once "db.php";
            $cartItemId = $_GET["removeCart"];
            $query = "DELETE FROM shopping_cart WHERE wishId = :wishId AND userId = :userId;";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':wishId', $cartItemId, PDO::PARAM_INT);
            $stmt->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_INT);
            $stmt->execute();
            http_response_code(200);
            echo json_encode([
                'success' => true
            ]);
            // -- Freeing resources -- //
            $pdo = null;
            exit();
        } catch (Exception $e) {
            http_response_code($e->getCode() ?: 500);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
            $pdo = null;
            exit();
        }
    }
    if (isset($_GET["checkout"])) {
        try {
            if (!empty($_GET["checkout"])) throw new Exception('No values required for this request', 400);
            if (!isset($_SESSION['userId'])) throw new Exception('User not logged in', 500);
            require_once "db.php";
            $query = "DELETE FROM shopping_cart WHERE userId = :userId;";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_INT);
            $stmt->execute();
            http_response_code(200);
            echo json_encode([
                'success' => true
            ]);
            // -- Freeing resources -- //
            $pdo = null;
            exit();
        } catch (Exception $e) {
            http_response_code($e->getCode() ?: 500);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
            $pdo = null;
            exit();
        }
    }


    if (isset($_GET["getCartItems"])) {
        try {
            if (!empty($_GET["getCartItems"])) throw new Exception('No values required for this request', 400);
            if (!isset($_SESSION['userId'])) throw new Exception('User not logged in', 401);
            
            require_once "db.php";
            $query = "SELECT COUNT(products.productId) as quantity, shopping_cart.wishId, products.productName, products.productPrice, products.linkImage
		                FROM shopping_cart
		                INNER JOIN products ON products.productId = shopping_cart.productId 
		                WHERE shopping_cart.userId = :userId
                        GROUP BY products.productId;";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'cartItems' => $result
            ]);
            $pdo = null;
            exit();
        } catch (Exception $e) {
            http_response_code($e->getCode() ?: 500);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
            $pdo = null;
            exit();
        }
    }
    if (isset($_GET["getTotal"])) {
        try {
            if (!empty($_GET["getTotal"])) throw new Exception('No values required for this request', 400);
            if (!isset($_SESSION['userId'])) throw new Exception('User not logged in', 401);
            
            require_once "db.php";
            $query = "SELECT SUM(products.productPrice) as total
		                FROM shopping_cart
		                INNER JOIN products ON products.productId = shopping_cart.productId 
		                WHERE shopping_cart.userId = :userId";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'total' => $result
            ]);
            $pdo = null;
            exit();
        } catch (Exception $e) {
            http_response_code($e->getCode() ?: 500);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
            $pdo = null;
            exit();
        }
    }
}

?>