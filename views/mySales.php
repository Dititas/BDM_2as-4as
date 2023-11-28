<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis ventas</title>

    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/stylesDashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/stylesMyWishLists.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://kit.fontawesome.com/3b5032f2e6.js" crossorigin="anonymous"></script>


</head>

<body>
    <?php include 'sidebar.php'; ?>

    <section class="home-selection">
        <div class="home-content">
            <i class="bx bx-menu"></i>
            <span class="text">Mis Ventas</span>
        </div>
    </section>
    <section class="dashboard-main">
        <section class="wishlists-container container flex-column">
            <section class="container mt-3">

                <div class="table-container container flex-column">
                    <h2>Historial de ventas</h2>
                    <table class="table table-striped table-hover table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"></th>
                                <th scope="col">Nombre del producto</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Fecha de compra</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="h-25">

                                <th scope="row">1</th>
                                <td>
                                    <img src="../img/mouse2.jfif" class="card-img-top img-fluid" alt="Imagen del producto 3">
                                </td>
                                <td>Mouse</td>
                                <td>$249.99</td>
                                <td>08 de julio de 2023</td>
                                
                            </tr>
                            <tr>

                                <th scope="row">2</th>
                                <td>
                                    <img src="../img/printer.jfif" class="card-img-top img-fluid" alt="Imagen del producto 2">
                                </td>
                                <td>Impresora láser</td>
                                <td>$1800</td>
                                <td>29 de mayo de 2023</td>
                                
                            </tr>
                            <tr>

                                <th scope="row">3</th>
                                <td>
                                    <img src="../img/keyboard.jfif" class="card-img-top img-fluid" alt="Imagen del producto">
                                </td>
                                <td>Teclado RGB</td>
                                <td>$500</td>
                                <td>10 de diciembre de 2022</td>

                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    </section>
    <script type="text/javascript" src="../scripts/scriptSidebar.js"></script>
</body>

</html>