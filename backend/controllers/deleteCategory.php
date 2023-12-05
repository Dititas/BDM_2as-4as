<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/category.php";

    if (
        isset($_POST['id']) &&
        isset($_POST['name']) &&
        isset($_POST['description'])
    ) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $isEnable = 0;
        $mysqli = dbConnection::connect();
        $Category = new Category();
        if ($Category->modifyCategory($mysqli, $id, $name, $description, $isEnable)) {
            $json_response = ["success" => true, "msg" => "Categoría eliminada con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al eliminar la categoría"];
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
