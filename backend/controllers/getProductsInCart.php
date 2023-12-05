<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Repite el mismo encabezado y configuración del servidor que en el primer controlador

    require_once "../utils/dbConnection.php";
    require_once "../model/cart.php";

    if (isset($_POST['idCart'])) {
        $idCart = $_POST['idCart'];

        $mysqli = dbConnection::connect();
        $cartModel = new Cart();

        $productsInCart = $cartModel->getProductsInCart($mysqli, $idCart);

        session_start();
        $_SESSION['productsInCart'] = $productsInCart;

        $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $productsInCart];
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit();
    } else {
        $json_response = ["success" => false, "msg" => "Parámetros incompletos, por favor proporcione 'idCart'"];
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit();
    }
}
?>