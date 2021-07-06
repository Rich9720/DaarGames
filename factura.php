<?php
    $total=$_REQUEST['total']??'';
    include_once "stripe/init.php";
    \Stripe\Stripe::setApiKey("sk_test_51J7bbzKRNMQQ2jYQiU8cmHxBVLNczgPrmqxgvFm6r247BgP1xCW0mV77WroJQjSTLdTimn83dSpJuFUsDEdfA40E00u50KbVv8");
    $toke=$_POST['stripeToken'];
    $charge=\Stripe\Charge::create([
        'amount'=>$total,
        'currency'=>'usd',
        'description'=>'Pago_prueba_sin_valor',
        'source'=>$toke
    ]);
    if($charge['captured']){
        $queryVenta="INSERT INTO ventas 
        (idClient                       ,idPago             ,fecha) values
        ('".$_SESSION['idCliente']."','".$charge['id']."',now());
        ";
        $resVenta=mysqli_query($con,$queryVenta);
        $id=mysqli_insert_id($con);
        
        $insertaDetalle="";
        $cantProd=count($_REQUEST['id']);
        for($i=0;$i<$cantProd;$i++){
            $subTotal=$_REQUEST['precio'][$i]*$_REQUEST['cantidad'][$i];
            $insertaDetalle=$insertaDetalle."(0,'".$_REQUEST['id'][$i]."','$id','".$_REQUEST['cantidad'][$i]."','".$_REQUEST['precio'][$i]."','$subTotal'),";
        }
        $insertaDetalle=rtrim($insertaDetalle,",");
        $queryDetalle="INSERT INTO detalleproducto 
        (id_detalle_product, id_producto, id_venta, cantidad, precio, subtotal) values 
        $insertaDetalle;";
        $resDetalle=mysqli_query($con,$queryDetalle);
        if($resVenta && $resDetalle){

            ?>
            <div class="row">
                <div class="col-6">
                    <?php muestraRecibe($id); ?>
                </div>
                <div class="col-6">
                    <?php muestraDetalle($id); ?>
                </div>
            </div>
            <?php
            borrarCarrito();
        }
    }
    function borrarCarrito(){
        ?>
            <script>
                $.ajax({
                    type: "post",
                    url: "ajax/borrarCarrito.php",
                    dataType: "json",
                    success: function (response) {
                        $("#badgeProducto").text("");
                        $("#listaCarrito").text("");
                    }
                });
            </script>
        <?php
    }
    function muestraRecibe($idVenta){
    ?>
    <table class="table">
        <thead>
            <tr>
                <th colspan="3" class="text-center">Persona que recibe</th>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Direccion</th>
            </tr>
        </thead>
        <tbody>
            <?php
                global $con;
                $queryRecibe="SELECT nombre,email,direccion 
                from recibe_producto 
                where idClient='".$_SESSION['idCliente']."';";
                $resRecibe=mysqli_query($con,$queryRecibe);
                $row=mysqli_fetch_assoc($resRecibe);
            ?>
            <tr>
                <td><?php echo $row['nombre'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['direccion'] ?></td>
            </tr>
        </tbody>
    </table>
    <?php
    }
    function muestraDetalle($idVenta){
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="3" class="text-center">Detalle de venta</th>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    global $con;
                    $queryDetalle="SELECT
                    p.nombre,
                    dv.cantidad,
                    dv.precio,
                    dv.subTotal
                    FROM
                    ventas AS v
                    INNER JOIN detalleproducto AS dv ON dv.id_venta = v.id_venta
                    INNER JOIN productos AS p ON p.id_producto = dv.id_producto
                    WHERE
                    v.id_venta = '$idVenta'";
                    $resDetalle=mysqli_query($con,$queryDetalle);
                    $total=0;
                    while($row=mysqli_fetch_assoc($resDetalle)){
                        $total=$total+$row['subTotal'];
                ?>
                <tr>
                    <td><?php echo $row['nombre'] ?></td>
                    <td><?php echo $row['cantidad'] ?></td>
                    <td><?php echo $row['precio'] ?></td>
                    <td><?php echo $row['subTotal'] ?></td>
                </tr>
                <?php
                    }
                ?>
                <tr>
                    <td colspan="3" class="text-right">Total:</td>
                    <td><?php echo $total; ?></td>
                </tr>

            </tbody>
        </table>
        <?php
        }
        ?>