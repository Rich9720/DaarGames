<div class="row mt-1">
                <?php
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
                        <a href="catalogoindex.php?modulo=detalleproducto&id=<?php echo $row['id_producto'] ?>" class="btn btn-primary">Ver</a>
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
                          <a class="page-link" href="catalogoindex.php?modulo=productosDescri&pagina=<?php echo ($paginaSel-1); ?>" aria-label="Previous">
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
                            <a class="page-link" href="catalogoindex.php?modulo=productosDescri&pagina=<?php echo $i; ?>"> <?php echo $i; ?></a>
                        </li>
                        <?php
                        }
                        ?>
                        <?php
                            if( $paginaSel!=$totalPaginas ){
                        ?>
                        <li class="page-item">
                          <a class="page-link" href="catalogoindex.php?modulo=productosDescri&pagina=<?php echo ($paginaSel+1); ?>" aria-label="Next">
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
