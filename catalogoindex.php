<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tienda || DaarGames </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="css/stripe.css">
    <?php
    session_start();
    $accion=$_REQUEST['accion']??'';
    if($accion=='cerrar'){
        session_destroy();
        header("Refresh:0");
    }
?>
</head>
<body>

<script src="plugins/jquery/jquery.min.js"></script>
<?php
include_once "db_conexion.php";
    $con = mysqli_connect($server,$username,$pass,$db);
     ?>             
                   
<?php
include_once "menu.php";
$modulo =$_REQUEST['modulo']??'';

if ($modulo == "productosDescri" || $modulo ==""){
    include_once "productosDescri.php";
}
if( $modulo=="detalleproducto" ){
    include_once "detalleProducto.php";
}
if( $modulo=="carrito" ){
    include_once "carrito.php";
}
if( $modulo=="envio" ){
    include_once "envio.php";
}
if( $modulo=="pasarela" ){
    include_once "pasarela.php";
}
if( $modulo=="factura" ){
    include_once "factura.php";
}
if( $modulo=="pedidosproductos" ){
    include_once "pedidosproductos.php";
}
?>

<footer> 

        <link rel="stylesheet" type="text/css" href="cssdg/Estilo_pie.css">
       
          <div class="container-footer-todo">
   
       <div class="container-body"> 
          <div class="colum1">
              <h1>Más información de la compañia</h1>
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
                      <label> <a href="https://www.instagram.com/daar.games/"> Siguenos en Instagram </label> </a>
               </div>
               
                <div class="info"> 
               
                     <img src="imagenes/iconos/twitter.jpg">
                     <label> <a href="https://twitter.com/DAARGAMES1"> Siguenos en Twiter </label> </a>
               </div>
           
           
           </div>
           
           
       <div class"colum3">
              
           <h1>Información Contactos</h1>
             
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
     
         @ 2021 Todos los derechos reservados <a href=""> Daar Games México</a>   
   </div>
      <div class="Information">
        <a href="">Información Compañia |</a>
        <a href="LFPDPPP.html">Privación y Politica |</a>  
        <a href="">Terminos y Condiciones</a>
        </div>
       </div>
   </footer>



    </div>

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
<script src="https://js.stripe.com/v3/"></script>
<script src="js/stripe.js"></script>
<script src="js/carritoDaaGames.js"></script>


</body>
</html>