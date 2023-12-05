<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/buyAndSale.php"; 

    if (isset($_POST['productId']) && isset($_POST['sellerId']) && isset($_POST['buyerId'])) {
        $productId = $_POST['productId'];
        $sellerId = $_POST['sellerId'];
        $buyerId = $_POST['buyerId'];

        $mysqli = dbConnection::connect();
        $transaction = new Transaction();

        if ($transaction->addTransaction($mysqli, $productId, $sellerId, $buyerId)) {
            $json_response = ["success" => true, "msg" => "Transacción agregada con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al agregar la transacción"];
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