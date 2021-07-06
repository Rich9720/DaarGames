<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Daar Games</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b> Tienda </b>DaarGames
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Logueate</p>
        <?php
        if (isset($_REQUEST['login'])) {
          session_start();
          $email = $_REQUEST['email'] ?? '';
          $pasword = $_REQUEST['pass'] ?? '';
          
          include_once "db_conexion.php";
          $con = mysqli_connect($server,$username,$pass,$db);
          $query = "SELECT idClient,nombre_completo,correo from clientes where correo ='" . $email . "' and pass= '" . $pasword . "';  ";
          $res = mysqli_query($con, $query);
          $row = mysqli_fetch_assoc($res);
          if ($row) {
            $_SESSION['idCliente'] = $row['idClient'];  
            $_SESSION['nombreCliente'] = $row['nombre_completo'];
            $_SESSION['emailCliente'] = $row['correo'];
            header("location: catalogoindex.php?mensaje=Usuario registrado exitosamente");
          } else {
        ?>
            <div class="alert alert-danger" role="alert">
              Intenta de nuevo 
            </div>
        <?php
          }
        }
        ?>
        <form method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="pass">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary" name="login">Loguearse</button>
              <a href="registro.php" class="text-success float-right" >Registrarse</a>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

</body>

</html>