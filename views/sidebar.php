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

    <!-- --------------------------------------EMPIEZA SIDEBAR-------------------------------- -->
    <div class="sidebar">
        <div class="sidebar__logo">
            <?php
            $ruta1 = '../img/logo.png';
            $ruta2 = './img/logo.png';

            if (file_exists($ruta1)) {
                echo '<img src="' . $ruta1 . '" class="imgSideBar">';
            } else {
                echo '<img src="' . $ruta2 . '" class="imgSideBar">';
            }
            ?>

        </div>
        <div class="sidebar__logo-collapsed">
            <?php
            $ruta1 = '../img/logocol.png';
            $ruta2 = './img/logocol.png';

            if (file_exists($ruta1)) {
                echo '<img src="' . $ruta1 . '" class="imgSideBar">';
            } else {
                echo '<img src="' . $ruta2 . '" class="imgSideBar">';
            }
            ?>


        </div>
        <ul class="sidebar__links">

            <?php if ($userRole) { ?>
                <li class="sidebar__link sidebar__search">
                    <?php
                    $ruta1 = '../views/search.php';
                    $ruta2 = './views/search.php';

                    if (file_exists($ruta1)) {
                        echo '<form action="' . $ruta1 . '">';
                    } else {
                        echo '<form action="' . $ruta2 . '" >';
                    }
                    ?>

                    <div class="d-flex">
                        <button type="submit" title="Buscar">
                            <i class="bx bxs-search buscar-btn-sb"></i>
                        </button>
                        <input type="text" name="search" placeholder="Buscar">
                    </div>
                    </form>
                </li>
                <li class="sidebar__link">
                    <?php
                    $ruta1 = 'index.php';
                    $ruta2 = '../index.php';

                    if (file_exists($ruta1)) {
                        echo '<a href="' . $ruta1 . '">';
                    } else {
                        echo '<a href="' . $ruta2 . '" >';
                    }
                    ?>
                    <i class='bx bxs-home'></i>
                    <span class="link_name">Inicio</span>
                    </a>
                </li>
                <li class="sidebar__link">
                    <?php
                    $ruta1 = './categories.php';
                    $ruta2 = './views/categories.php';

                    if (file_exists($ruta1)) {
                        echo '<a href="' . $ruta1 . '">';
                    } else {
                        echo '<a href="' . $ruta2 . '" >';
                    }
                    ?>

                    <i class='bx bxs-category-alt'></i>
                    <span class="link_name">Categorias</span>
                    </a>
                </li>
                <?php
                if ($userRole !== 'Administrador') {
                ?>
                    <li class="sidebar__link">
                        <?php
                        $ruta1 = './myWishlists.php';
                        $ruta2 = './views/myWishlists.php';

                        if (file_exists($ruta1)) {
                            echo '<a href="' . $ruta1 . '">';
                        } else {
                            echo '<a href="' . $ruta2 . '" >';
                        }
                        ?>
                        <i class='bx bx-list-ul'></i>
                        <span class="link_name">Mis listas</span>
                        </a>
                    </li>
                    <li class="sidebar__link">
                        <?php
                        $ruta1 = './myChats.php';
                        $ruta2 = './views/myChats.php';

                        if (file_exists($ruta1)) {
                            echo '<a href="' . $ruta1 . '">';
                        } else {
                            echo '<a href="' . $ruta2 . '" >';
                        }
                        ?>

                        <i class='bx bx-conversation'></i>
                        <span class="link_name">Mis Chats</span>
                        </a>
                    </li>
                <?php
                }
                ?>

                <?php
                if ($userRole === 'Comprador') {
                ?>
                    <li class="sidebar__link">
                        <?php
                        $ruta1 = './myShoppingCart.php';
                        $ruta2 = './views/myShoppingCart.php';

                        if (file_exists($ruta1)) {
                            echo '<a href="' . $ruta1 . '">';
                        } else {
                            echo '<a href="' . $ruta2 . '" >';
                        }
                        ?>

                        <i class='bx bxs-cart-download'></i>
                        <span class="link_name">Mi Carrito</span>
                        </a>
                    </li>
                    <li class="sidebar__link">
                        <?php
                        $ruta1 = './myShopping.php';
                        $ruta2 = './views/myShopping.php';

                        if (file_exists($ruta1)) {
                            echo '<a href="' . $ruta1 . '">';
                        } else {
                            echo '<a href="' . $ruta2 . '" >';
                        }
                        ?>


                        <i class='bx bx-shopping-bag'></i>
                        <span class="link_name">Mis Compras</span>
                        </a>
                    </li>
                <?php
                }
                ?>

                <?php
                if ($userRole === 'Vendedor') {
                ?>
                    <li class="sidebar__link">
                        <?php
                        $ruta1 = './myProducts.php';
                        $ruta2 = './views/myProducts.php';

                        if (file_exists($ruta1)) {
                            echo '<a href="' . $ruta1 . '">';
                        } else {
                            echo '<a href="' . $ruta2 . '" >';
                        }
                        ?>

                        <i class='bx bxs-box'></i>
                        <span class="link_name">Mis productos</span>
                        </a>
                    </li>
                    <li class="sidebar__link">
                        <?php
                        $ruta1 = './mySales.php';
                        $ruta2 = './views/mySales.php';

                        if (file_exists($ruta1)) {
                            echo '<a href="' . $ruta1 . '">';
                        } else {
                            echo '<a href="' . $ruta2 . '" >';
                        }
                        ?>
                        <i class='bx bx-money-withdraw'></i>
                        <span class="link_name">Mis ventas</span>
                        </a>
                    </li>
                    <li class="sidebar__link">
                        <?php
                        $ruta1 = './inventory.php';
                        $ruta2 = './views/inventory.php';

                        if (file_exists($ruta1)) {
                            echo '<a href="' . $ruta1 . '">';
                        } else {
                            echo '<a href="' . $ruta2 . '" >';
                        }
                        ?>

                        <i class='bx bx-package'></i>
                        <span class="link_name">Inventario</span>
                        </a>
                    </li>
                <?php
                }
                ?>

                <li class="sidebar__link">
                    <?php
                    $ruta1 = './myProfile.php';
                    $ruta2 = './views/myProfile.php';

                    if (file_exists($ruta1)) {
                        echo '<a href="' . $ruta1 . '">';
                    } else {
                        echo '<a href="' . $ruta2 . '" >';
                    }
                    ?>
                    <i class='bx bxs-user'></i>
                    <span class="link_name">Mi Perfil</span>
                    </a>
                </li>
                <!-- ***************************************************************************************** -->
                <li class="sidebar__link">
                    <?php
                    $ruta1 = './myOrders.php';
                    $ruta2 = './views/myOrders.php';

                    if (file_exists($ruta1)) {
                        echo '<a href="' . $ruta1 . '">';
                    } else {
                        echo '<a href="' . $ruta2 . '" >';
                    }
                    ?>

                    <i class='bx bx-trending-up'></i>
                    <span class="link_name">Mis pedidos</span>
                    </a>
                </li>

                <!-- ***************************************************************************************** -->
                <li class="sidebar__link sidebar__link-user">
                    <div class="profile-details">
                        <div class="profile-content sidebar__img">
                            <img class="img-profile" src="<?php echo  $urlImagen; ?>" alt="FotoDePerfil">
                        </div>
                        <div class="name-job">
                            <div class="profile_name sidebar__username"><?php echo $userName ?></div>
                            <div class="rol sidebar__role"><?php echo $userRole ?></div>
                        </div>
                        <?php
                        $ruta1 = '../backend/controllers/closeSession.php';
                        $ruta2 = './backend/controllers/closeSession.php';

                        if (file_exists($ruta1)) {
                            echo '<form action="' . $ruta1 . '">';
                        } else {
                            echo '<form action="' . $ruta2 . '" >';
                        }
                        ?>
                        <button type="submit" class="bg-transparent border-0 sidebar__button">
                            <i class='bx logout bxs-log-out'></i>
                        </button>
                        </form>

                    </div>
                </li>
            <?php } else { ?>
                <li class="sidebar__link sidebar__search">
                    <?php
                    $ruta1 = '../views/search.php';
                    $ruta2 = './views/search.php';

                    if (file_exists($ruta1)) {
                        echo '<form action="' . $ruta1 . '">';
                    } else {
                        echo '<form action="' . $ruta2 . '" >';
                    }
                    ?>
                    <div class="d-flex">
                        <button type="submit" title="Buscar">
                            <i class="bx bxs-search buscar-btn-sb"></i>
                        </button>
                        <input type="text" name="search" placeholder="Buscar">
                    </div>
                    </form>
                </li>
                <li class="sidebar__link">
                    <?php
                    $ruta1 = 'index.php';
                    $ruta2 = '../index.php';

                    if (file_exists($ruta1)) {
                        echo '<a href="' . $ruta1 . '">';
                    } else {
                        echo '<a href="' . $ruta2 . '" >';
                    }
                    ?>
                    <i class='bx bxs-home'></i>
                    <span class="link_name">Inicio</span>
                    </a>
                </li>
                <!-- Sidebar para sesión no activa -->
                <li class="sidebar__link sidebar__link-user">
                    <div class="profile-details d-flex">
                        <?php
                        $ruta1 = '../views/login.php';
                        $ruta2 = './views/login.php';

                        if (file_exists($ruta1)) {
                            echo '<form action="' . $ruta1 . '">';
                        } else {
                            echo '<form action="' . $ruta2 . '" >';
                        }
                        ?>

                        <button type="submit" class="btn btn-dark sidebar__button">
                            <span>Iniciar Sesión</span>
                            <i class='bx bxs-log-in bx-flashing bx-flip-vertical'></i>
                        </button>
                        </form>
                    </div>
                </li>
            <?php } ?>


        </ul>
    </div>