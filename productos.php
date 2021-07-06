<?php
  include_once "db_conexion.php";
  $con = mysqli_connect($server,$username,$pass,$db);
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Productos</h1>
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
                <table id="tablaproducto" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  <th>Id Productos</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Existencia</th> 
                    <th>Imagenes</th>      
                  </tr>
                  </thead>
                 
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
