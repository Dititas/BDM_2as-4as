<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/product.php";

    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['image']) && isset($_POST['quotation']) && isset($_POST['price']) && isset($_POST['quantityAvailable']) && isset($_POST['isEnable']) && isset($_POST['user'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $quotation = $_POST['quotation'];
        $price = $_POST['price'];
        $quantityAvailable = $_POST['quantityAvailable'];
        $isEnable = $_POST['isEnable'];
        $user = $_POST['user'];

        $mysqli = dbConnection::connect();
        $productModel = new Product();

        if ($productModel->modifyProduct($mysqli, $name, $description, $image, $quotation, $price, $quantityAvailable, $isEnable, $user)) {
            $json_response = ["success" => true, "msg" => "Producto modificado con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al modificar el producto"];
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