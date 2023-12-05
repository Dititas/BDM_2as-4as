<?php
require_once "../utils/dbConnection.php";
require_once "../model/buyAndSale.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['idSeller']) && isset($_POST['startDate']) && isset($_POST['endDate']) && isset($_POST['categoryFilter'])) {
        $idSeller = $_POST['idSeller'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $categoryFilter = $_POST['categoryFilter'];

        $mysqli = dbConnection::connect();
        $transaction = new Transaction();

        $salesDetails = $transaction->getSalesDetails($mysqli, $idSeller, $startDate, $endDate, $categoryFilter);

        session_start();
		$_SESSION['SalesDetails'] = $salesDetails;

        $json_response = ["success" => true, "msg" => "Consulta exitosa"];
        header('Content-Type: application/json');
    	echo json_encode($json_response);
    	exit();
    } else {
        $json_response = ["success" => false, "msg" => "Parámetros incompletos"];
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit();
    }
}
?>