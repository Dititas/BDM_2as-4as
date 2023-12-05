<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/conversation.php";

    if (isset($_POST['seller'])) {
        $seller = $_POST['seller'];

        $mysqli = dbConnection::connect();
        $conversationModel = new Conversation();

        $conversationsSeller = $conversationModel->getConversationsSeller($mysqli, $seller);

        if ($conversationsSeller !== null) {
            session_start();
            $_SESSION['conversationsSeller'] = $conversationsSeller;
            $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $conversationsSeller];
        } else {
            $json_response = ["success" => false, "msg" => "Error al obtener las conversaciones del vendedor"];
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