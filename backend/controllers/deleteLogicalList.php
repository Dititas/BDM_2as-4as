<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/wishList.php";

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $mysqli = dbConnection::connect();
        $wishListModel = new WishList();

        if ($wishListModel->deleteLogicalList($mysqli, $id)) {
            $json_response = ["success" => true, "msg" => "Lista de deseos eliminada lógicamente con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al eliminar lógicamente la lista de deseos"];
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