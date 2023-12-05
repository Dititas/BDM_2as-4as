<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/quotation.php";

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $mysqli = dbConnection::connect();
        $quotationModel = new Quotation();

        $quotations = $quotationModel->getAllQuotationOneSeller($mysqli, $id);

        if ($quotations !== null) {
            session_start();
            $_SESSION['quotations'] = $quotations;
            $json_response = ["success" => true, "msg" => "Consulta exitosa", "data" => $quotations];
        } else {
            $json_response = ["success" => false, "msg" => "Error al obtener las cotizaciones del vendedor"];
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