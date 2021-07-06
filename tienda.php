
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav class="navbar navbar-expand navbar-dark">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="index.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                    </ul>
                    <!-- SEARCH FORM -->
                    <form class="form-inline ml-3" action="catalogoindex.php" >
                        <div class="input-group input-group-sm">
                         <input class="form-control form-control-navbar bg-gray" type="search" placeholder="Search" aria-label="Search" name="nombre" value="<?php echo $_REQUEST['nombre']??''; ?>" > 
                         <input type="hidden" name="modulo" value="productos">
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
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <span class="badge badge-danger navbar-badge">3</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Brad Diesel
                                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">Call me whenever you can...</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                John Pierce
                                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">I got your message bro</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Nora Silvester
                                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">The subject goes here</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                            </div>
                        </li>
                        <!-- Notifications Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <span class="dropdown-item dropdown-header">15 Notifications</span>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                                    <span class="float-right text-muted text-sm">3 mins</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-users mr-2"></i> 8 friend requests
                                    <span class="float-right text-muted text-sm">12 hours</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-file mr-2"></i> 3 new reports
                                    <span class="float-right text-muted text-sm">2 days</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="row mt-1">
                <?php
                  include_once "db_conexion.php";
                  $con = mysqli_connect($server,$username,$pass,$db);
                  $where=" where 1=1 ";
                  $nombre= mysqli_real_escape_string($con,$_REQUEST['nombre']??'');
                  if( empty($nombre)==false ){
                      $where="and nombre like '%".$nombre."%'";
                  }
                  $queryCuenta='SELECT COUNT(*) as cuenta FROM productos  $where ;';
                  $resCuenta=mysqli_query($con,$queryCuenta);
                  $rowCuenta=mysqli_fetch_assoc($resCuenta);
                  $totalRegistros=$rowCuenta['cuenta'];

                  $elementosPorPagina=9;

                  $totalPaginas=ceil($totalRegistros/$elementosPorPagina);

                  $paginaSel=$_REQUEST['pagina']??false;

                  if($paginaSel==false){
                      $inicioLimite=0;
                      $paginaSel=1;
                  }else{
                      $inicioLimite=($paginaSel-1)* $elementosPorPagina;
                  }
                  $limite=" limit $inicioLimite,$elementosPorPagina ";

                  $query = "SELECT  p.id_producto, p.nombre, p.precio, p.existencia,f.web_path
                  FROM productos AS p 
                  INNER JOIN productos_files AS pf ON pf.producto_id=p.id_producto INNER JOIN files AS f ON f.id=pf.file_id
                 $where
                  GROUP BY p.id_producto
                  $limite
                  ;
                  ";
              $res = mysqli_query($con, $query);
              while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card border-primary">
                      <img class="card-img-top img-thumbnail" src="<?php echo $row['web_path'] ?>" alt="">
                      <div class="card-body">
                        <h2 class="card-title"><strong><?php echo $row['nombre'] ?></strong></h2>
                        <p class="card-text"><strong>Precio:</strong><?php echo "$", $row['precio'], " MNX" ?></p>
                        <p class="card-text"><strong>Existencia:</strong><?php echo $row['existencia'] ?></p>
                        <a href="#" class="btn btn-primary" >Ver</a>
                      </div>
                    </div>
              
                </div>
                
                <?php
            }
            ?>
                </div>
                <?php
                if($totalPaginas>0){
                ?>
                    <nav aria-label="Page navigation">
                      <ul class="pagination">
                        <?php
                            if( $paginaSel!=1 ){
                        ?>
                        <li class="page-item">
                          <a class="page-link" href="catalogoindex.php?modulo=productos&pagina=<?php echo ($paginaSel-1); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                        <?php
                        }
                        ?>

                        <?php
                        for($i=1;$i<=$totalPaginas;$i++){
                        ?>
                        <li class="page-item <?php echo ($paginaSel==$i)?" active ":" "; ?>">
                            <a class="page-link" href="catalogoindex.php?modulo=productos&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php
                        }
                        ?>
                        <?php
                            if( $paginaSel!=$totalPaginas ){
                        ?>
                        <li class="page-item">
                          <a class="page-link" href="catalogoindex.php?modulo=productos&pagina=<?php echo ($paginaSel+1); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                        <?php
                            }
                        ?>
                      </ul>
                    </nav>
                <?php
                }
                ?>
<footer> 
        <link rel="stylesheet" type="text/css" href="cssdg/Estilo_pie.css">
       
          <div class="container-footer-todo">
   
       <div class="container-body"> 
          <div class="colum1">
              <h1>Mas informacion de la compañia</h1>
              <p> Daar Games es una empresa 100% mexicana dedicada a la venta de videojuegos online.</p>           
           </div>

           <div class="colum2">
               
               <h1>Redes Sociales</h1>
               
                 <div class="info"> 
               
                     <img src="imagenes/iconos/facebook.png">
                     <label> <a href="https://www.facebook.com/Daar-Games-105588858046389"> Siguenos en Facebook </label> </a>
               </div>
               
                <div class="info"> 
               
                     <img src="imagenes/iconos/instagram.jpg">
                      <label> <a href=""> Siguenos en Instagram </label> </a>
               </div>
               
                <div class="info"> 
               
                     <img src="imagenes/iconos/twitter.jpg">
                     <label> <a href=""> Siguenos en Twiter </label> </a>
               </div>
           
           
           </div>
           
           
       <div class"colum3">
              
           <h1>Informacion Contactos</h1>
             
            <div class="info2"> 
               
                     <img src="imagenes/iconos/casa.png">
                     <label> Avenida Mario Colin, Tlalnepantla de Baz </label>
               </div>
           
           
            <div class="info2"> 
               
                     <img src="imagenes/iconos/phone.png">
                     <label> +52-56-11-76-98-50  </label>
               </div>
           
            <div class="info2"> 
               
                     <img src="imagenes/iconos/carta.png">
                     <label> soporte_tecnico@daargames.store </label>
               </div>
           </div>  
       
       </div>
       </div>      

        <div class="container-footer">
        <div class="copyright">
     
         @ 2021 Todos los derechos reservados <a href=""> Daar Games </a>   
   </div>
      <div class="Information">
        <a href="../principal.php">Informacion Compañia |</a>
        <a href="">Privacion y Politica |</a>  
        <a href="">Terminis y Condiciones</a>
        </div>
       </div>
   </footer>















<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>


</body>
</html>