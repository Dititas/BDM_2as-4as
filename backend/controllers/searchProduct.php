<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/product.php";

    if (isset($_POST['search'])) {
        $search = $_POST['search'];

        $mysqli = dbConnection::connect();
        $productModel = new Product();

        $searchedProducts = $productModel->searchProduct($mysqli, $search);

        if ($searchedProducts !== null) {
            session_start();
            $_SESSION['searchedProducts'] = $searchedProducts;
            $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $searchedProducts];
        } else {
            $json_response = ["success" => false, "msg" => "Error al buscar productos"];
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