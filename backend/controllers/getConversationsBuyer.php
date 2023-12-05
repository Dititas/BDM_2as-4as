<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/conversation.php";

    if (isset($_POST['buyer'])) {
        $buyer = $_POST['buyer'];

        $mysqli = dbConnection::connect();
        $conversationModel = new Conversation();

        $conversationsBuyer = $conversationModel->getConversationsBuyer($mysqli, $buyer);

        if ($conversationsBuyer !== null) {
            session_start();
            $_SESSION['conversationsBuyer'] = $conversationsBuyer;
            $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $conversationsBuyer];
        } else {
            $json_response = ["success" => false, "msg" => "Error al obtener las conversaciones del comprador"];
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