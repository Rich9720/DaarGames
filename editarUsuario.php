<?php
  include_once "db_conexion.php";
  $con = mysqli_connect($server,$username,$pass,$db);

if(isset($_REQUEST['guardar'])){
    
    $email= mysqli_real_escape_string($con,  $_REQUEST['email']??'');
    $password_user= mysqli_real_escape_string($con,  $_REQUEST['password_usuario']??'');
    $name= mysqli_real_escape_string($con,  $_REQUEST['name_user']??'');
    $id= mysqli_real_escape_string($con,  $_REQUEST['id']??'');
    
    $query= "UPDATE usuarios_daargames 
             SET   email= '".$email."' ,password= '".$password_user."',  nombre= '".$name."'
             where id='".$id."'; 
             ";
              
    $res=mysqli_query($con,$query);
    if($res){
        echo '<meta http-equiv="refresh" content="0; url=indexpanel.php?modulo=usuarios&mensaje=Usuario '.$name.' editado exitosamente"/> ';
    } 
    else{
        ?>
        <div class="alert alert-danger" role="alert"> 
       Error al crear Usuario <?php echo mysqli_error($con); ?>
        <?php


    }
}
$id=mysqli_real_escape_string($con, $_REQUEST['id']??'');
$query="SELECT id, nombre, email from usuarios_daargames  where id = '".$id."';";
$res=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($res);
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
                 <form action="indexpanel.php?modulo=editarUsuario" method="post">
                    <div class="form-group">
                    <label> Correo </label>
                        <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>" require="requiere"> 
                    </div>
                    <div class="form-group">
                    <label> Password </label>
                        <input type="password" name="password_usuario" class="form-control" require="requiere> 
                    </div>
                    <div class="form-group">
                    <label> Nombre </label>
                        <input type="text" name="name_user" class="form-control" value="<?php echo $row['nombre'] ?>"require="requiere> 
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
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
