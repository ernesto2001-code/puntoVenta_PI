<?php 
ob_start();
include_once "includes/header.php";
require("../conexion.php");
$id_user = $_SESSION['idUser'];
$permiso = "nueva_venta";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location:permisos.php");
}
?>
<div class="row">
    <div class="col-lg-12">
        <br>
        <a href="buscar_productos.php"><button class="btn btn-primary" id="abrir">Agregar Producto <i class="fas fa-cart-plus"></i></button></a>
        <div class="table-responsive">
        <br>
        <?php
            $total = 0;
            if (isset($_SESSION['carrito'])) 
            {?>
                
            <table class="table table-hover" id="tblDetalle">
                <thead class="thead-dark">
                    <tr>
                        <th>Codigo</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody id="detalle_venta">
                <?php
                    foreach ($_SESSION["carrito"] as $indice => $arreglo) {
                        $total += $arreglo["canti"] * $arreglo["precio"];                                        
                            echo "<tr>";
                            foreach ($arreglo as $key => $value) {
                                echo "<th>" .$value. "</th>";
                            }
                            echo "<th><a href='ventas.php?item=$indice' class='btn btn-danger'><i class='fas fa-trash'></a></th>";
                            echo "</tr>";
                        }?>
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan=3>Total a pagar: $<?php echo $total?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <?php }
            else {
                echo "<table class='table table-hover' id='tbblDetalle'>
                                <thead class='thead-dark'>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Accion</th>
                                </tr>
                                </thead>
                                <tbody id='detalle_venta'>
                                    <tr>
                                        <th>Vacio</th>
                                    </tr>
                                </tbody>
                                </table>";
            }
            ?>
        </div>
    </div>
    <div class="col-md-6">
        <?php
        
        ?>
        <a href="ventas.php?pagar=true" class="btn btn-success" id="btn_generar">    Pagar    <i class="fas fa-cash-register"></i></a>
        
        <a href="ventas.php?vaciar=true" class="btn btn-warning" id="btn_generar" style="color: #000;">    Vaciar    </a>
        <?php
        $date = date('Y-m-d');
        $usuario = $_SESSION['nombre'];

        if (isset($_REQUEST["item"])) {

            $producto = $_REQUEST["item"];
            unset($_SESSION["carrito"][$producto]);
        }

        if (isset($_REQUEST["vaciar"])) {
            unset($_SESSION["carrito"]);
        }

            if (isset($_REQUEST['pagar'])) {

                $consulta = "INSERT INTO `ventas`(`usuario`,`fecha`, `total`) VALUES ('$usuario','$date', '$total')";

                $resultado = $conexion -> query($consulta);

                if ($resultado) {
                    unset($_SESSION["carrito"]);
                }
            }
        ?>

    </div>

</div>
<?php include_once "includes/footer.php"; ?>