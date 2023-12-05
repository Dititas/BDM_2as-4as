<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/product.php";

    if (isset($_POST['userId']) && isset($_POST['productId'])) {
        $userId = $_POST['userId'];
        $productId = $_POST['productId'];

        $mysqli = dbConnection::connect();
        $productModel = new Product();

        $isInCart = $productModel->isProductInCart($mysqli, $userId, $productId);

        if ($isInCart !== null) {
            session_start();
            $_SESSION['isInCart'] = $isInCart;
            $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $isInCart];
        } else {
            $json_response = ["success" => false, "msg" => "Error al verificar si el producto está en el carrito"];
        }

        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit();
    } else {
        $json_response = ["success" => false, "msg" => "Verifique sus datos, están corruptos"];
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit();
    }
}
?>