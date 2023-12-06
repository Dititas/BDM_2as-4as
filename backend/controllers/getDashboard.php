<?php
    require_once "../utils/dbConnection.php";
    require_once "../model/product.php";

    $mysqli = dbConnection::connect();
    $productModel = new Product();    


    // Controlador para los últimos productos
    $lastProducts = $productModel->getLastProducts($mysqli);
    // Controlador para los productos más gustados
    $mostLikedProducts = $productModel->getMostLikedProducts($mysqli);
    // Controlador para los productos más vendidos
    $mostSoldProducts = $productModel->getMostSoldProducts($mysqli);

    if ($lastProducts !== null && $mostLikedProducts !== null && $mostSoldProducts !== null) {        
        session_start();
        $_SESSION['last_products'] = $lastProducts;
        $_SESSION['most_liked_products'] = $mostLikedProducts;
        $_SESSION['most_sold_products'] = $mostSoldProducts;
        echo "Éxito";
        header("Location: ../views/dashboard.php");
        exit();
    } else {
        $_SESSION['last_products'] = null;
        $_SESSION['most_liked_products'] = null;
        $_SESSION['most_sold_products'] = null;
        echo "Falló";
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);
    exit();

?>