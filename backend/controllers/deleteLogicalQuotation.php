<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/quotation.php";

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $mysqli = dbConnection::connect();
        $quotationModel = new Quotation();

        if ($quotationModel->deleteLogicalQuotation($mysqli, $id)) {
            $json_response = ["success" => true, "msg" => "Cotización eliminada lógicamente con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al eliminar lógicamente la cotización"];
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