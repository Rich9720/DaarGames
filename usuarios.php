<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
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
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                    <th>Crear Usuarios </th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php
                      include_once "db_conexion.php";
                      $con = mysqli_connect($server,$username,$pass,$db);
                      $query= "SELECT id, nombre, email from usuarios_daargames;";
                      $res=mysqli_query($con,$query);

                      while($row=mysqli_fetch_assoc($res)){
                      ?>
                  <tr>
                    <td><?php echo $row['id'] ?></td>   
                    <td><?php echo $row['nombre'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td> <a href ="indexpanel.php?modulo=editarUsuario&id=<?php echo $row['id'] ?>" style="margin-left: 40px;">  <i class="fas fa-edit "> </i> </a> </td>
                    <td> <a href ="usuarios.php?idBorrar=<?php echo $row['id'] ?>" class="text-danger" style="margin-left: 30px;" > <i class="fas fa-trash "> </i> </a>
                    <td> <a href ="indexpanel.php?modulo=agregarUsuarios" style="margin-left: 50px;">  <i class="fas fa-user "> </i> </a>    
                </td>
                </tr>
                        <?php
                      }
                        ?>
                </table>
                      </tbody>
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
