<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/rating.php";

    if (isset($_POST['idRating']) && isset($_POST['score']) && isset($_POST['comment']) && isset($_POST['isEnable']) && isset($_POST['user'])) {
        $idRating = $_POST['idRating'];
        $score = $_POST['score'];
        $comment = $_POST['comment'];
        $isEnable = $_POST['isEnable'];
        $user = $_POST['user'];

        $mysqli = dbConnection::connect();
        $ratingModel = new Rating();

        if ($ratingModel->modifyRating($mysqli, $idRating, $score, $comment, $isEnable, $user)) {
            $json_response = ["success" => true, "msg" => "Valoración modificada con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al modificar la valoración"];
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