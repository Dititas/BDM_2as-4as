<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/wishList.php";

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $mysqli = dbConnection::connect();
        $wishListModel = new WishList();

        $lists = $wishListModel->getListByUser($mysqli, $id);

        if ($lists !== null) {
            session_start();
            $_SESSION['wishLists'] = $lists;
            $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $lists];
        } else {
            $json_response = ["success" => false, "msg" => "Error al obtener las listas de deseos por usuario"];
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