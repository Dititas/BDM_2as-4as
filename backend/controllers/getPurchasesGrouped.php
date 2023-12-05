<?php
// Repite el mismo encabezado y configuración del servidor que en el primer controlador

require_once "../utils/dbConnection.php";
require_once "../model/buyAndSale.php";

// Verifica los parámetros necesarios según tu lógica de solicitud
if (isset($_POST['idBuyer']) && isset($_POST['startDate']) && isset($_POST['endDate']) && isset($_POST['categoryFilter'])) {
    $idBuyer = $_POST['idBuyer'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $categoryFilter = $_POST['categoryFilter'];

    $mysqli = dbConnection::connect();
    $transaction = new Transaction(); // Asegúrate de reemplazar "YourModel" con el nombre real de tu modelo

    $purchasesGrouped = $transaction->getPurchasesGrouped($mysqli, $idBuyer, $startDate, $endDate, $categoryFilter);

    session_start();
    $_SESSION['PurchasesGrouped'] = $purchasesGrouped;

    $json_response = ["success" => true, "msg" => "Consulta exitosa"];
    header('Content-Type: application/json');
    echo json_encode($json_response);
    exit();
} else {
    // Maneja el caso en el que no se proporcionen los parámetros esperados
    $json_response = ["success" => false, "msg" => "Parámetros incompletos"];
    header('Content-Type: application/json');
    echo json_encode($json_response);
    exit();
}
?>