<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/category.php";

    if (isset($_POST['name']) && isset($_POST['description'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        session_start();
        $loggedUser = $_SESSION['AUTH'] ?? null;

        $mysqli = dbConnection::connect();
        $newCategory = new Category();
        if ($newCategory->addCategory($mysqli, $name, $description, $loggedUser['user_id'])) {
            $json_response = ["success" => true, "msg" => "Categoría agregada con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al agregar la categoría"];
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
