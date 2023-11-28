   
   <?php
     if (!isset($_SESSION["AUTH"]))
        session_start();
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
   <!-- --------------------------------------EMPIEZA SIDEBAR-------------------------------- -->
    <div class="sidebar">
            <div class="logo-details">
                <img src="/BDM_2AS-4AS/img/logo.jpg" class="imgSideBar">
            </div>
            <ul class="nav-links">

                <?php if (isset($_SESSION["AUTH"])) { ?>
                    <li>
                        <form action="/BDM_2AS-4AS/views/search.php">
                            <div class="buscar">
                                <input type="text" name="search" placeholder="Buscar">
                                <button type="submit">
                                    <i class="bx bxs-search buscar-btn-sb"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                    <li>
                        <form action="/BDM_2AS-4AS/index.php">
                            <button type="submit" class="bg-dark border-0 boton">
                                <i class='bx bxs-home'></i>
                                <span class="link_name">Inicio</span>
                            </button>
                        </form>
                    </li>                    
                    <li>
                        <form action="/BDM_2AS-4AS/views/categories.php">
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
                            <form action="/BDM_2AS-4AS/views/myWishlists.php">
                                <button type="submit" class="bg-dark border-0 boton">
                                    <i class='bx bx-list-ul'></i>
                                    <span class="link_name">Mis listas</span>
                                </button>
                            </form>
                        </li>
                        <li>
                           <form action="/BDM_2AS-4AS/views/myChats.php">
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
                            <form action="/BDM_2AS-4AS/views/myShoppingCart.php">
                                <button type="submit" class="bg-dark border-0 boton">
                                    <i class='bx bxs-cart-download'></i>
                                    <span class="link_name">Mi Carrito</span>
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="/BDM_2AS-4AS/views/myShopping.php">
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
                            <form action="/BDM_2AS-4AS/views/myProducts.php">
                                <button type="submit" class="bg-dark border-0 boton">
                                    <i class='bx bxs-box'></i>
                                    <span class="link_name">Mis productos</span>
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="/BDM_2AS-4AS/views/mySales.php">
                                <button type="submit" class="bg-dark border-0 boton">
                                    <i class='bx bx-money-withdraw'></i>
                                    <span class="link_name">Mis ventas</span>
                                </button>
                            </form>
                        </li>
						<li>
                    	    <form action="/BDM_2AS-4AS/views/myOrders.php">
                    	        <button type="submit" class="bg-dark border-0 boton">
                    	            <i class='bx bx-trending-up'></i>
                    	            <span class="link_name">Mis pedidos</span>
                    	        </button>
                    	    </form>
                    	</li>
                    <?php
                        }
                    ?>

                    <li>
                        <form action="/BDM_2AS-4AS/views/profile.php">
                            <button type="submit" class="bg-dark border-0 boton">
                                <i class='bx bxs-user'></i>
                                <span class="link_name">Mi Perfil</span>
                            </button>
                        </form>
                    </li>
                    <!-- ***************************************************************************************** -->

                    <!-- <li>
                        <form action="./inventory.php">
                            <button type="submit" class="bg-dark border-0 boton">
                                <i class='bx bx-package'></i>
                                <span class="link_name">Inventario</span>
                            </button>
                        </form>
                    </li> -->
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
                        <form action="/BDM_2AS-4AS/views/search.php">
                            <div class="buscar">
                                <input type="text" name="search" placeholder="Buscar">
                                <button type="submit">
                                    <i class="bx bxs-search buscar-btn-sb"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                    <li>
                        <form action="/BDM_2AS-4AS/index.php">
                            <button type="submit" class="bg-dark border-0 boton">
                                <i class='bx bxs-home'></i>
                                <span class="link_name">Inicio</span>
                            </button>
                        </form>
                    </li>
                    <!-- Sidebar para sesión no activa -->
                    <li>
                        <div class="profile-details">
                            <form action="/BDM_2AS-4AS/views/login.php">
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
