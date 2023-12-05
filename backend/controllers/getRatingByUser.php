<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/rating.php";

    if (isset($_POST['user'])) {
        $user = $_POST['user'];

        $mysqli = dbConnection::connect();
        $ratingModel = new Rating();

        $ratings = $ratingModel->getRatingByUser($mysqli, $user);

        if ($ratings !== null) {
            session_start();
            $_SESSION['ratings'] = $ratings;
            $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $ratings];
        } else {
            $json_response = ["success" => false, "msg" => "Error al obtener las valoraciones del usuario"];
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