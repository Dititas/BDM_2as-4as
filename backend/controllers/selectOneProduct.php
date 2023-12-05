<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/product.php";

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $mysqli = dbConnection::connect();
        $productModel = new Product();

        $oneProduct = $productModel->selectOneProduct($mysqli, $id);

        if ($oneProduct !== null) {
            session_start();
            $_SESSION['oneProduct'] = $oneProduct;
            $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $oneProduct];
        } else {
            $json_response = ["success" => false, "msg" => "Error al obtener el producto"];
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