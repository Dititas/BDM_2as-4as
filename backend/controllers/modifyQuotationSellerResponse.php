<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../utils/dbConnection.php";
    require_once "../model/quotation.php";

    if (isset($_POST['id']) && isset($_POST['expirationDate']) && isset($_POST['priceAgreed'])) {
        $id = $_POST['id'];
        $expirationDate = $_POST['expirationDate'];
        $priceAgreed = $_POST['priceAgreed'];

        $mysqli = dbConnection::connect();
        $quotationModel = new Quotation();

        if ($quotationModel->modifyQuotationSellerResponse($mysqli, $id, $expirationDate, $priceAgreed)) {
            $json_response = ["success" => true, "msg" => "Respuesta del vendedor modificada con éxito"];
        } else {
            $json_response = ["success" => false, "msg" => "Error al modificar la respuesta del vendedor"];
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