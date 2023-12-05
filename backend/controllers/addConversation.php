<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/conversation.php";

    if (isset($_POST['seller']) && isset($_POST['buyer']) && isset($_POST['product'])) {
        $seller = $_POST['seller'];
        $buyer = $_POST['buyer'];
        $product = $_POST['product'];

        $mysqli = dbConnection::connect();
        $conversationModel = new Conversation();

        if ($conversationModel->addConversation($mysqli, $seller, $buyer, $product)) {
            $json_response = ["success" => true, "msg" => "Conversación creada con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al crear la conversación"];
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