<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/conversation.php";

    if (isset($_POST['idConversation'])) {
        $idConversation = $_POST['idConversation'];

        $mysqli = dbConnection::connect();
        $conversationModel = new Conversation();

        $allMessages = $conversationModel->getAllMessages($mysqli, $idConversation);

        if ($allMessages !== null) {
            session_start();
            $_SESSION['allMessages'] = $allMessages;
            $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $allMessages];
        } else {
            $json_response = ["success" => false, "msg" => "Error al obtener todos los mensajes"];
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