<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/wishList.php";

    if (
        isset($_POST['name']) &&
        isset($_POST['description']) &&
        isset($_POST['isPublic'])
    ) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $isPublic = $_POST['isPublic'];
        session_start();
        $loggedUser = $_SESSION['AUTH'] ?? null;

        $mysqli = dbConnection::connect();
        $wishlist = new WishList();
        if ($wishlist->addList($mysqli, $name, $description, $isPublic, $loggedUser['user_id'])) {
            $json_response = ["success" => true, "msg" => "Lista agregada con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al agregar la lista"];
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
