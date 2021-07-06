<?php
if(isset($_REQUEST['guardar'])){
    include_once "db_conexion.php";
    $con = mysqli_connect($server,$username,$pass,$db);
    
    $email= mysqli_real_escape_string($con,  $_REQUEST['email']??'');
    $password_user= mysqli_real_escape_string($con,  $_REQUEST['password_usuario']??'');
    $name= mysqli_real_escape_string($con,  $_REQUEST['name_user']??'');
    
    $query= "INSERT INTO usuarios_daarGames (id,  email,      password,        nombre) 
                VALUES                      (0,'".$email."','".$password_user."', '".$name."');
                ";
    $res=mysqli_query($con,$query);
    if($res){
        echo '<meta http-equiv="refresh" content="0; url=indexpanel.php?modulo=usuarios&mensaje=Usuario Creado exitosamente"/> ';
    } 
    else{
        ?>
        <div class="alert alert-danger" role="alert"> 
       Error al crear Usuario <?php echo mysqli_error($con); ?>
        <?php


    }
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crear usuario</h1>
          </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            <!-- /.card-header -->
              <div class="card-body">
                 <form action="indexpanel.php?modulo=agregarUsuarios" method="post">
                    <div class="form-group">
                    <label> Correo </label>
                        <input type="email" name="email" class="form-control" require="requiere"> 
                    </div>
                    <div class="form-group">
                    <label> Password </label>
                        <input type="password" name="password_usuario" class="form-control" require="requiere"> 
                    </div>
                    <div class="form-group">
                    <label> Nombre </label>
                        <input type="text" name="name_user" class="form-control" require="requiere"> 
                    </div>
                    <div class="form-group">
                    <button type ="submit" class="btn btn-primary" name="guardar"> Agregar </button>
                    </div>

                 </form>
                 </div> 
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
