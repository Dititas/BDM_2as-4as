<!DOCTYPE html>
<html>

<head>
	<?php
	//include 'urls.php';

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

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;600&display=swap" rel="stylesheet">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

	<script src="https://kit.fontawesome.com/3b5032f2e6.js" crossorigin="anonymous"></script>

	<title>Bytes & Bites</title>

</head>

<body class="bg-dark">





    <!-- --------------------------------------EMPIEZA SIDEBAR-------------------------------- -->
        <div class="sidebar">
            <div class="logo-details">
                <img src="./img/logo.jpg" class="imgSideBar">
            </div>
            <ul class="nav-links">

                <?php if (isset($_SESSION["AUTH"])) { ?>
                    <li>
                        <form action="./search.php">
                            <div class="buscar">
                                <input type="text" name="search" placeholder="Buscar">
                                <button type="submit">
                                    <i class="bx bxs-search buscar-btn-sb"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                    <li>
                        <form action="./dashboard.php">
                            <button type="submit" class="bg-dark border-0 boton">
                                <i class='bx bxs-home'></i>
                                <span class="link_name">Inicio</span>
                            </button>
                        </form>
                    </li>                    
                    <li>
                        <form action="./categories.php">
                            <button type="submit" class="bg-dark border-0">
                                <i class='bx bxs-category-alt'></i>
                                <span class="link_name">Categorias</span>
                            </button>
                        </form>
                    </li>
                    <?php
                        if($userRole !== 'Administrador'){
                    ?>
                        <li>
                            <form action="./myWishlists.php">
                                <button type="submit" class="bg-dark border-0 boton">
                                    <i class='bx bx-list-ul'></i>
                                    <span class="link_name">Mis listas</span>
                                </button>
                            </form>
                        </li>
                        <li>
                           <form action="./myChats.php">
                                 <button type="submit" class="bg-dark border-0 boton">
                                    <i class='bx bx-conversation'></i>
                                    <span class="link_name">Mis Chats</span>
                                </button>
                            </form>
                        </li>                        
                    <?php        
                        }
                    ?>
                    
                    <?php
                        if($userRole === 'Comprador'){
                    ?>
                        <li>
                            <form action="./myShoppingCart.php">
                                <button type="submit" class="bg-dark border-0 boton">
                                    <i class='bx bxs-cart-download'></i>
                                    <span class="link_name">Mi Carrito</span>
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="./myShopping.php">
                                <button type="submit" class="bg-dark border-0 boton">
                                    <i class='bx bx-shopping-bag'></i>
                                    <span class="link_name">Mis Compras</span>
                                </button>
                            </form>
                        </li>
                    <?php
                        }
                    ?>
                    
                    <?php
                        if($userRole === 'Vendedor'){
                    ?>
                        <li>
                            <form action="./myProducts.php">
                                <button type="submit" class="bg-dark border-0 boton">
                                    <i class='bx bxs-box'></i>
                                    <span class="link_name">Mis productos</span>
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="./mySales.php">
                                <button type="submit" class="bg-dark border-0 boton">
                                    <i class='bx bx-money-withdraw'></i>
                                    <span class="link_name">Mis ventas</span>
                                </button>
                            </form>
                        </li>
                    <?php
                        }
                    ?>

                    <li>
                        <form action="./myProfile.php">
                            <button type="submit" class="bg-dark border-0 boton">
                                <i class='bx bxs-user'></i>
                                <span class="link_name">Mi Perfil</span>
                            </button>
                        </form>
                    </li>
                    <!-- ***************************************************************************************** -->
                    <li>
                        <form action="./myOrders.php">
                            <button type="submit" class="bg-dark border-0 boton">
                                <i class='bx bx-trending-up'></i>
                                <span class="link_name">Mis pedidos</span>
                            </button>
                        </form>
                    </li>
                    <li>
                        <form action="./inventory.php">
                            <button type="submit" class="bg-dark border-0 boton">
                                <i class='bx bx-package'></i>
                                <span class="link_name">Inventario</span>
                            </button>
                        </form>
                    </li>
                    <!-- ***************************************************************************************** -->
                    <li>
                        <div class="profile-details">                            
                            <div class="profile-content">
                                <img class="img-profile" src="<?php echo  $urlImagen; ?>" alt="FotoDePerfil">
                            </div>
                            <div class="name-job">
                                <div class="profile_name"><?php echo $userName ?></div>
                                <div class="rol"><?php echo $userRole ?></div>
                            </div>
                            <form action="./backend/controllers/closeSession.php">
                                <button type="submit" class="bg-dark-x border-0">
                                    <i class='bx logout bxs-log-out'></i>
                                </button>
                            </form>
                
                        </div>
                    </li>
                <?php } else { ?>
                    <li>
                        <form action="">
                            <div class="buscar">
                                <input type="text" name="search" placeholder="Buscar">
                                <button type="submit">
                                    <i class="bx bxs-search buscar-btn-sb"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                    <li>
                        <form action="././index.php">
                            <button type="submit" class="bg-dark border-0 boton">
                                <i class='bx bxs-home'></i>
                                <span class="link_name">Inicio</span>
                            </button>
                        </form>
                    </li>
                    <!-- Sidebar para sesión no activa -->
                    <li>
                        <div class="profile-details">
                            <form action="./views/login.php">
                                <button type="submit" class="btn btn-dark">
                                    Iniciar Sesión
                                    <i class='bx bxs-log-in bx-flashing bx-flip-vertical'></i>
                                </button>
                            </form>
                        </div>
                    </li>
                <?php } ?>
                
                
            </ul>
        </div>
    <!-- --------------------------------------TERMINA SIDEBAR-------------------------------- -->





	<section class="home-selection">
		<div class="home-content">
			<i class="bx bx-menu"></i>
			<span class="text">Bienvenido</span>
		</div>
	</section>
	<section class="dashboard-main">
		<section class="container d-flex flex-column">
			<h2>Últimos Productos</h2>
			<div id="carouselLastProducts" class="carousel" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/audifonos.jfif" class="d-block w-100" alt="Imagen del producto 1">
							</div>
							<div class="card-body">
								<h5 class="card-title">Audifonos</h5>
								<p class="card-text">Alta calidad de audio</p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/audifonos2.jfif" class="d-block w-100" alt="Imagen del producto 2">
							</div>

							<div class="card-body">
								<h5 class="card-title">Audífonos bluetooth</h5>
								<p class="card-text">Dura la pila hasta 30 horas</p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/audifonos2.jfif" class="d-block w-100" alt="Imagen del producto 2">
							</div>

							<div class="card-body">
								<h5 class="card-title">Audífonos bluetooth</h5>
								<p class="card-text">Dura la pila hasta 30 horas</p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/audifonos2.jfif" class="d-block w-100" alt="Imagen del producto 2">
							</div>

							<div class="card-body">
								<h5 class="card-title">Audífonos bluetooth</h5>
								<p class="card-text">Dura la pila hasta 30 horas</p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/keyboard2.jfif" class="d-block w-100" alt="Imagen del producto 3">
							</div>
							<div class="card-body">
								<h5 class="card-title">Teclado</h5>
								<p class="card-text">Teclado para computadora</p>
							</div>
						</div>
					</div>

					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/cargador.jfif" class="card-img-top img-fluid" alt="Imagen del producto 3">
							</div>

							<div class="card-body">
								<h5 class="card-title">Cargador</h5>
								<p class="card-text">Cargador de laptop Lenovo</p>
							</div>
						</div>
					</div>




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
			<br>
			<h2>Recomendados</h2>
			<div id="carouselRecommended" class="carousel" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/keyboard.jfif" class="card-img-top img-fluid" alt="Imagen del producto 1">
							</div>

							<div class="card-body">
								<h5 class="card-title">Teclado</h5>
								<p class="card-text">Teclado RGB</p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/mouse3.jfif" class="card-img-top img-fluid" alt="Imagen del producto 2">
							</div>

							<div class="card-body">
								<h5 class="card-title">Mouse</h5>
								<p class="card-text">Mouse gamer para PC</p>
							</div>
						</div>
					</div>

					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/mouse3.jfif" class="card-img-top img-fluid" alt="Imagen del producto 2">
							</div>

							<div class="card-body">
								<h5 class="card-title">Mouse</h5>
								<p class="card-text">Mouse gamer para PC</p>
							</div>
						</div>
					</div>


					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/mouse2.jfif" class="card-img-top img-fluid" alt="Imagen del producto 3">
							</div>

							<div class="card-body">
								<h5 class="card-title">Mouse</h5>
								<p class="card-text">Mouse con luces RGB</p>
							</div>
						</div>
					</div>

					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/audifonos3.jfif" class="card-img-top img-fluid" alt="Imagen del producto 3">
							</div>

							<div class="card-body">
								<h5 class="card-title">Audífonos</h5>
								<p class="card-text">Audífonos de diadema</p>
							</div>
						</div>

					</div>
					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/mouse2.jfif" class="card-img-top img-fluid" alt="Imagen del producto 3">
							</div>

							<div class="card-body">
								<h5 class="card-title">Mouse</h5>
								<p class="card-text">Mouse con luces RGB</p>
							</div>
						</div>
					</div>

					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/audifonos3.jfif" class="card-img-top img-fluid" alt="Imagen del producto 3">
							</div>

							<div class="card-body">
								<h5 class="card-title">Audífonos</h5>
								<p class="card-text">Audífonos de diadema</p>
							</div>
						</div>

					</div>

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

			<br>
			<h2>Más Vendidos</h2>
			<div id="carouselMostSelled" class="carousel" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<div class="card bg-dark">
							<div>
								<div class="img-wrapper">
									<img src="./img/laptop.jfif" class="card-img-top img-fluid" alt="Imagen del producto 3">
								</div>


							</div>
							<div class="card-body">
								<h5 class="card-title">Laptop</h5>
								<p class="card-text">Laptop HP</p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/mouse3.jfif" class="card-img-top img-fluid" alt="Imagen del producto 2">
							</div>

							<div class="card-body">
								<h5 class="card-title">Mouse</h5>
								<p class="card-text">Mouse gamer para PC</p>
							</div>
						</div>
					</div>


					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/mouse2.jfif" class="card-img-top img-fluid" alt="Imagen del producto 3">
							</div>

							<div class="card-body">
								<h5 class="card-title">Mouse</h5>
								<p class="card-text">Mouse con luces RGB</p>
							</div>
						</div>
					</div>

					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/audifonos3.jfif" class="card-img-top img-fluid" alt="Imagen del producto 3">
							</div>

							<div class="card-body">
								<h5 class="card-title">Audífonos</h5>
								<p class="card-text">Audífonos de diadema</p>
							</div>
						</div>

					</div>
					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/printer.jfif" class="card-img-top img-fluid" alt="Imagen del producto 2">
							</div>

							<div class="card-body">
								<h5 class="card-title">Impresora</h5>
								<p class="card-text">Impresora láser</p>
							</div>
						</div>
					</div>

					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/printer2.jfif" class="card-img-top img-fluid" alt="Imagen del producto 3">
							</div>

							<div class="card-body">
								<h5 class="card-title">Impresora</h5>
								<p class="card-text">Impresora a color</p>
							</div>
						</div>
					</div>

					<div class="carousel-item">
						<div class="card bg-dark">
							<div class="img-wrapper">
								<img src="./img/laptop2.jfif" class="card-img-top img-fluid" alt="Imagen del producto 3">
							</div>

							<div class="card-body">
								<h5 class="card-title">Laptop</h5>
								<p class="card-text">Laptop 16GB RAM</p>
							</div>
						</div>
					</div>



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
	<?php

	?>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script type="text/javascript" src="./scripts/scriptDashboard.js"></script>

</body>

</html>