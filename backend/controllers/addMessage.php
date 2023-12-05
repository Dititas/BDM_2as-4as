<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/conversation.php";

    if (isset($_POST['text']) && isset($_POST['conversation']) && isset($_POST['sender'])) {
        $text = $_POST['text'];
        $conversation = $_POST['conversation'];
        $sender = $_POST['sender'];

        $mysqli = dbConnection::connect();
        $conversationModel = new Conversation();

        if ($conversationModel->addMessage($mysqli, $text, $conversation, $sender)) {
            $json_response = ["success" => true, "msg" => "Mensaje agregado con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al agregar el mensaje"];
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