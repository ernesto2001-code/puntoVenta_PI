<?php
include_once "includes/header.php";
require_once "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "ventas";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
$query = mysqli_query($conexion, "SELECT * FROM detalle_ventas");
?>
<table class="table table-light" id="tbl">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Vendedor</th>
            <th>Fecha</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['usuario']; ?></td>
                <td><?php echo $row['fecha']; ?></td>
                <td>$<?php echo $row['total'];?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php include_once "includes/footer.php"; ?>