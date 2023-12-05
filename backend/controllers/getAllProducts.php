<?php
require_once "../utils/dbConnection.php";
require_once "../model/product.php";

// Intenta establecer la conexión a la base de datos
$mysqli = dbConnection::connect();

// Verifica si la conexión se realizó con éxito
if (!$mysqli) {
    $json_response = ["success" => false, "msg" => "Error de conexión a la base de datos"];
} else {
    // La conexión se realizó con éxito, procede con la obtención de productos
    $product = new Product();
    $products = $product->getAllProducts($mysqli);

    if ($products !== null) {
        $json_response = ["success" => true, "products" => $products];
    } else {
        $json_response = ["success" => false, "msg" => "Error al obtener los productos"];
    }
}

// Establece el encabezado y envía la respuesta JSON al cliente
header('Content-Type: application/json');
echo json_encode($json_response);
?>
