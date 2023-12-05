<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/product.php";

    if (isset($_POST['productId'])) {
        $productId = $_POST['productId'];

        $mysqli = dbConnection::connect();
        $productModel = new Product();

        $averageRating = $productModel->getAverageProductRatings($mysqli, $productId);

        if ($averageRating !== null) {
            session_start();
            $_SESSION['averageRating'] = $averageRating;
            $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $averageRating];
        } else {
            $json_response = ["success" => false, "msg" => "Error al obtener el promedio de calificaciones"];
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