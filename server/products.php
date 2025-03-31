<?php
const ITEMSPERBATCH = 10;
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    //If Request is from index.html
    if (isset($_GET["batch"]) && !empty(trim($_GET["batch"]))){
        $page = ($_GET["batch"]-1)*ITEMSPERBATCH;
        
        try{
            require_once "db.php";
            $isSearch = isset($_GET["search"]) && !empty(trim($_GET["search"]) && $_GET["search"] != "");
            $isGender = isset($_GET["gender"]) && !empty(trim($_GET["gender"]) && $_GET["gender"] != "");
            $isBrand = isset($_GET["brand"]) && !empty(trim($_GET["brand"]) && isset($_GET["brand"]) != "");
            //If client are requesting with filters
            if ($isSearch || $isGender || $isBrand) {
                $query = "SELECT * FROM products WHERE ";
                $countQuery = "SELECT COUNT(*) FROM products WHERE ";
                $conditions = [];
                
                if ($isSearch) {
                $conditions[] = "productName LIKE :search";
                }
                if ($isGender) {
                $conditions[] = "GENDER = :gender";
                }
                if ($isBrand) {
                $conditions[] = "BRAND = :brand";
                }
                $query .= implode(" AND ", $conditions) . " LIMIT :limit OFFSET :offset";
                $countQuery .= implode(" AND ", $conditions);
                $countRequest = $pdo->prepare($countQuery);
                $stmt = $pdo->prepare($query);

                if ($isSearch) { 
                $search = '%' . trim($_GET["search"]) . '%';
                $stmt->bindValue(':search', $search, PDO::PARAM_STR);
                $countRequest->bindValue(':search', $search, PDO::PARAM_STR);
                }
                if ($isGender) { 
                $gender = trim($_GET["gender"]);
                $stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
                $countRequest->bindValue(':gender', $gender, PDO::PARAM_STR);
                }
                if ($isBrand) { 
                $brand = trim($_GET["brand"]);
                $stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
                $countRequest->bindValue(':brand', $brand, PDO::PARAM_STR);
                }
            } else {
                $countQuery = "SELECT COUNT(*) FROM products";
                $countRequest = $pdo->prepare($countQuery);
                $stmt = $pdo->prepare("SELECT * FROM products LIMIT :limit OFFSET :offset");
            }
            $stmt->bindValue(':limit', ITEMSPERBATCH, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $page, PDO::PARAM_INT);
            $stmt->execute();

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $countRequest->execute();
            $countResponse = $countRequest->fetch(PDO::FETCH_ASSOC);
            $canRequest = ((int) $countResponse['COUNT(*)'])-($_GET["batch"])*ITEMSPERBATCH >= 0;

            $response = [
                'status'=> 200,
                'products'=> $products,
                'canRequestNext' => $canRequest
            ];

            header('Content-Type: application/json');
            echo json_encode($response);

        }
        catch(PDOException $e){
            $response = [
                'status'=> 500,
                'message' => $e->getMessage(),
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } 
    //If request is from product.html
    else if ((isset($_GET["productId"]) && !empty(trim($_GET["productId"])))){
        try{
            require_once "db.php";

            $stmt = $pdo->prepare("SELECT * FROM products WHERE productId = :productId");
            $stmt->bindValue(':productId', $_GET["productId"], PDO::PARAM_INT);
            $stmt->execute();

            $product = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $response = [
                'status'=> 200,
                'product'=> $product,
            ];

            header('Content-Type: application/json');
            echo json_encode($response);
        }
        catch(PDOException $e){
            $response = [
                'status'=> 500,
                'message' => $e->getMessage(),
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

}
?>