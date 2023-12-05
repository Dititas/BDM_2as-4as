<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/rating.php";

    if (isset($_POST['score']) && isset($_POST['comment']) && isset($_POST['product']) && isset($_POST['user'])) {
        $score = $_POST['score'];
        $comment = $_POST['comment'];
        $product = $_POST['product'];
        $user = $_POST['user'];

        $mysqli = dbConnection::connect();
        $ratingModel = new Rating();

        if ($ratingModel->addRating($mysqli, $score, $comment, $product, $user)) {
            $json_response = ["success" => true, "msg" => "Valoración agregada con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al agregar la valoración"];
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