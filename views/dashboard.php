<!DOCTYPE html>
<html>

<head>
    <?php

    $userInfo;
    $userName;
    $userRole;
    $urlImagen;

    if (isset($_SESSION["AUTH"])) {
        $userInfo = $_SESSION["AUTH"];
        $userName = $userInfo["user_userName"];
        $userRole = $userInfo["user_rol"];
        if ($userRole === 'buyer') {
            $userRole = 'Comprador';
        } else if ($userRole === 'seller') {
            $userRole = 'Vendedor';
        } else {
            $userRole = 'Administrador';
        }
        $imagenCodificada = base64_encode($userInfo["user_image"]);
        $urlImagen = 'data:image/jpeg;base64,' . $imagenCodificada;
    } else {
        $userInfo = "";
        $userName = "";
        $userRole = "";
    }


    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/stylesDashboard.css">
    <link rel="stylesheet" type="text/css" href="./css/stylesSidebar.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://kit.fontawesome.com/3b5032f2e6.js" crossorigin="anonymous"></script>

    <title>Bytes & Bites</title>

</head>

<body>
    <?php include_once(__DIR__ . "././sidebar.php");   ?>


    <section class="home-selection">
        <div class="home-content">
            <i id="toggle-sidebar" class="bx bx-menu"></i>
            <span class="text">Bienvenido</span>
        </div>
    </section>
    <section class="dashboard-main">
        <section class="container d-flex flex-column">
            <h2>Últimos Productos</h2>
            <div id="carouselLastProducts" class="carousel" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    foreach ($_SESSION['last_products'] as $product) {
                        ?>
                        <div class="carousel-item">
                            <div class="card bg-dark">
                                <div class="img-wrapper">
                                    <img src="data:image/jpeg;base64,<?= base64_encode($product['product_image']); ?>" class="card-img-top img-fluid" alt="Imagen del producto">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $product['product_name']; ?></h5>
                                    <p class="card-text"><?= $product['product_description']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselLastProducts" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselLastProducts" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <h2>Recomendados</h2>
            <div id="carouselRecommended" class="carousel" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    foreach ($_SESSION['recommended_products'] as $product) {
                        ?>
                        <div class="carousel-item">
                            <div class="card bg-dark">
                                <div class="img-wrapper">
                                    <img src="data:image/jpeg;base64,<?= base64_encode($product['product_image']); ?>" class="card-img-top img-fluid" alt="Imagen del producto">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $product['product_name']; ?></h5>
                                    <p class="card-text"><?= $product['product_description']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselRecommended" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselRecommended" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <h2>Más Vendidos</h2>
            <div id="carouselMostSelled" class="carousel" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    foreach ($_SESSION['most_sold_products'] as $product) {
                        ?>
                        <div class="carousel-item">
                            <div class="card bg-dark">
                                <div class="img-wrapper">
                                    <img src="data:image/jpeg;base64,<?= base64_encode($product['product_image']); ?>" class="card-img-top img-fluid" alt="Imagen del producto">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $product['product_name']; ?></h5>
                                    <p class="card-text"><?= $product['product_description']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselMostSelled" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselMostSelled" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </section>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="./scripts/scriptDashboard.js"></script>
    <script type="text/javascript" src="./scripts/scriptSidebar.js"></script>

</body>

</html>