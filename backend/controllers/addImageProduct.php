<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/product.php";

    if (isset($_POST['image']) && isset($_POST['product'])) {
        $image = $_POST['image'];
        $product = $_POST['product'];

        $mysqli = dbConnection::connect();
        $productModel = new Product();

        if ($productModel->insertImage($mysqli, $image, $product)) {
            $json_response = ["success" => true, "msg" => "Imagen agregada con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al agregar la imagen"];
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