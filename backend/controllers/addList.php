<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/wishList.php";

    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['isPublic']) && isset($_POST['userOwner'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $isPublic = $_POST['isPublic'];
        $userOwner = $_POST['userOwner'];

        $mysqli = dbConnection::connect();
        $wishListModel = new WishList();

        if ($wishListModel->addList($mysqli, $name, $description, $isPublic, $userOwner)) {
            $json_response = ["success" => true, "msg" => "Lista de deseos agregada con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al agregar la lista de deseos"];
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