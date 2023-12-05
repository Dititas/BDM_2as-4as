<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

        $purchasesDetails = $transaction->getPurchasesDetails($mysqli, $idBuyer, $startDate, $endDate, $categoryFilter);

        session_start();
		$_SESSION['PurchasesDetails'] = $purchasesDetails;

        $json_response = ["success" => true, "msg" => "Consulta Exitosa"];
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