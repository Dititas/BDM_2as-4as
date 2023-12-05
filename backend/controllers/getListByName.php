<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/wishList.php";

    if (isset($_POST['name'])) {
        $name = $_POST['name'];

        $mysqli = dbConnection::connect();
        $wishListModel = new WishList();

        $lists = $wishListModel->getListByName($mysqli, $name);

        if ($lists !== null) {
            session_start();            
            $_SESSION['wishLists'] = $lists;
            $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $lists];
        } else {
            $json_response = ["success" => false, "msg" => "Error al obtener las listas de deseos por nombre"];
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