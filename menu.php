<nav class="navbar navbar-expand navbar-dark">
<img class="animation__shake brand-image img-circle elevation-3" src="dist/img/Daargames_logo.jpg" alt="AdminLTELogo" height="60" width="60" >
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="catalogoindex.php" class="nav-link">Inicio</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">Contacto</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="pedidosproductos.php" class="nav-link">Mis pedidos</a>
                        </li>
                    </ul>

                    <!-- SEARCH FORM -->
                    <form class="form-inline ml-3" action="catalogoindex.php" >
                        <div class="input-group input-group-sm">
                         <input class="form-control form-control-navbar bg-gray" type="search" placeholder="Search" aria-label="Search" name="nombre" value="<?php echo $_REQUEST['nombre']??''; ?>" > 
                         <input type="hidden" name="modulo" value="productosDescri">
                            <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Messages Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#" id="iconoCarrito">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <span class="badge badge-danger navbar-badge" id="badgeProducto"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="listaCarrito">

                            </div>
                        </li>
                        <!-- Notifications Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                <?php
                                if (isset($_SESSION['idCliente']) == false) {
                                ?>
                                    <a href="login.php" class="dropdown-item">
                                        <i class="fas fa-door-open mr-2 text-primary"></i>Loguearse
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="registro.php" class="dropdown-item">
                                        <i class="fas fa-sign-in-alt mr-2 text-primary"></i>Registrarse
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a href="catalogoindex.php?modulo=usuario" class="dropdown-item">
                                        <i class="fas fa-user text-primary mr-2"></i>Hola <?php echo $_SESSION['nombreCliente']; ?>
                                    </a>
                                    <form action="catalogoindex.php" method="post">
                                        <button name="accion" class="btn btn-danger dropdown-item" type="submit" value="cerrar">
                                            <i class="fas fa-door-closed text-danger mr-2"></i>Cerrar sesion
                                        </button>
                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                        </li>
                    </ul>
                </nav>
                <?php
                $mensaje = $_REQUEST['mensaje'] ?? '';
                if ($mensaje) {
                ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <?php echo $mensaje; ?>
                    </div>
                <?php
                }
                ?> 