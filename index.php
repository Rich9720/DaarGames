<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DaarGames | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head> 
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Ingreso</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicia seción para acceder a tu cuenta</p>
<?php
  if (isset($_REQUEST['login'])) {
    session_start();
    $email= $_REQUEST['email'] ?? '';
    $password= $_REQUEST['pass'] ?? '';
    include_once "db_conexion.php";
    $con = mysqli_connect($server,$username,$pass,$db);
    $query= "SELECT id, nombre, email from usuarios_daargames where email ='" . $email . "' and password='" . $password . "'; ";
    $res=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($res);
    if($row){
      $_SESSION['id']=$row['id'];
      $_SESSION['nombre']=$row['nombre'];
      $_SESSION['email']=$row['email'];
      header("location: indexpanel.php");
    }
    else{
      ?>
  <div class="alert alert-danger" role ="alert">
    ERROR LOGIN
    </div>
      <?php
  }
  }
      ?>

      <form method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name= "email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Constraseña" name ="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="login">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p> Iniciar con: </p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Iniciar con Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Iniciar con Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">Olvidé contraseña</a>
      </p>
      <p class="mb-0">
        <a href="registro.php" class="text-center">Registrate si eres nuevo</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
