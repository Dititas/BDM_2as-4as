<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Repite el mismo encabezado y configuración del servidor que en el primer controlador

    require_once "../utils/dbConnection.php";
    require_once "../model/cart.php";

    if (isset($_POST['idUser'])) {
        $idUser = $_POST['idUser'];

        $mysqli = dbConnection::connect();
        $cartModel = new Cart();

        $cartByUser = $cartModel->getCartByUser($mysqli, $idUser);

        session_start();
        $_SESSION['cartByUser'] = $cartByUser;

        $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $cartByUser];
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit();
    } else {
        $json_response = ["success" => false, "msg" => "Parámetros incompletos, por favor proporcione 'idUser'"];
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit();
    }
}
?>