<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/quotation.php";

    if (isset($_POST['specifications']) && isset($_POST['product']) && isset($_POST['user'])) {
        $specifications = $_POST['specifications'];
        $product = $_POST['product'];
        $user = $_POST['user'];

        $mysqli = dbConnection::connect();
        $quotationModel = new Quotation();

        if ($quotationModel->addQuotationBuyerRequest($mysqli, $specifications, $product, $user)) {
            $json_response = ["success" => true, "msg" => "Cotización agregada con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al agregar la cotización"];
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