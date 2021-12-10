<?php 
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
<!DOCTYPE html>
<html lang="es">
<style>
    thead{
        background: #fb9509;
        color: #fff;
    }
</style>
<body>
    <div class="container-fluid">
                            <h1>Agregar Producto</h1>
                            <form action="" method="get" class="form_search">
                                <input type="text" name="busqueda" id="buscqueda" placeholder="Buscar...">
                                <input type="submit"  name="buscar" value="Buscar" class="btnSearch">
                            </form>
                            <br><hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>CODIGO</th>
                                        <th>DESCRIPCION</th>
                                        <th>PRECIO</th>
                                        <th>ACCION</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            <tbody>
                            <?php 
                                if (isset($_GET['buscar'])) {
                                    $busqueda = $_GET['busqueda'];
                            
                                    $consulta = "SELECT * FROM `producto` WHERE (`codigo` LIKE '%$busqueda%') OR (`descripcion` LIKE '%$busqueda%')";
                                    $query = mysqli_query($conexion, $consulta);

                                    while($row = mysqli_fetch_array($query)){
                                
                            ?>
                                <tr>
                                    <th><?php echo $row['codigo']?></th>
                                    <th><?php echo $row['descripcion']?></th>
                                    <th><?php echo "$". $row['precio']?></th>
                                    <th><form action="buscar_productos.php" method="POST">
                                            <input type="hidden" name="txtId" value="<?php echo $row['codproducto']?>">
                                            <input type="hidden" name="txtCodigo" value="<?php echo $row['codigo']?>">
                                            <input type="hidden" name="txtDescripcion" value="<?php echo $row['descripcion']?>">
                                            <input type="hidden" name="txtPrecio" value="<?php echo $row['precio']?>">
                                            <input type="hidden" name="txtStock" value="<?php echo $row['existencia']?>">
                                            <input type="number" name="cant" value="1" width="50px">
                                            <input type="submit" value="Agregar" name="btnAgregar">
                                        </form></th>
                                </tr>
                            <?php
                                }
                            }
                            ?>
                            </tbody>
                            </table>
                            <a href="ventas.php"><button id="cerrar" class="btn btn-secondary"><i class="far fa-hand-point-left"></i>  Atras </button></a>

                            <?php
                                if (isset($_REQUEST["btnAgregar"])) {
                                    $idProducto = $_REQUEST['txtId'];
                                    $producto = $_REQUEST['txtDescripcion']; 
                                    $codigo = $_REQUEST['txtCodigo'];
                                    $cantidad = $_REQUEST['cant'];
                                    $precio = $_REQUEST['txtPrecio'];

                                    $_SESSION["carrito"][$producto]["idProdu"] = $idProducto;
                                    $_SESSION["carrito"][$producto]["code"] = $codigo;
                                    $_SESSION["carrito"][$producto]["name"] = $producto;
                                    $_SESSION["carrito"][$producto]["canti"] = $cantidad;
                                    $_SESSION["carrito"][$producto]["precio"] = $precio;


                                    echo "<script>alert('Producto $codigo $producto Agregado con exito.');</script>";
                                }
                            ?>
        </div>
</body>
</html>