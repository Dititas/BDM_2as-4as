<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/buyAndSale.php"; 

    // Verifica los parámetros necesarios según tu lógica de solicitud
    if (isset($_POST['idSeller']) && isset($_POST['startDate']) && isset($_POST['endDate']) && isset($_POST['categoryFilter'])) {
        $idSeller = $_POST['idSeller'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $categoryFilter = $_POST['categoryFilter'];

        $mysqli = dbConnection::connect();
        $transaction = new Transaction(); // Asegúrate de reemplazar "YourModel" con el nombre real de tu modelo

        $salesGrouped = $transaction->getSalesGrouped($mysqli, $idSeller, $startDate, $endDate, $categoryFilter);

        session_start();
		$_SESSION['SalesGrouped'] = $salesGrouped;

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
}
?>