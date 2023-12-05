<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/wishList.php";

    if (isset($_POST['image']) && isset($_POST['id'])) {
        $image = $_POST['image'];
        $id = $_POST['id'];

        $mysqli = dbConnection::connect();
        $wishListModel = new WishList();

        if ($wishListModel->addImageList($mysqli, $image, $id)) {
            $json_response = ["success" => true, "msg" => "Imagen de lista de deseos agregada con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al agregar la imagen de la lista de deseos"];
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