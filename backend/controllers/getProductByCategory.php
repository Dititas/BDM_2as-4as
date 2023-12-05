<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/category.php";

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $mysqli = dbConnection::connect();
        $categoryModel = new Category();

        $productsByCategory = $categoryModel->getProductByCategory($mysqli, $id);

        if ($productsByCategory !== null) {
            session_start();
            $_SESSION['productsByCategory'] = $productsByCategory;
            $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $productsByCategory];
        } else {
            $json_response = ["success" => false, "msg" => "Error al obtener los productos por categoría"];
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