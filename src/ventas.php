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

if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>
<div class="col-xs-12">
		<h1>Realizar Venta</h1>
		<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
					VENTA REALIZADA CORRECTAMENTE.
					<?php
				}else if($_GET["status"] === "2"){
					?>
						VENTA CANCELADA.
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<
                    PRODUCTO ELIMINADO.
					
					<?php
				}else if($_GET["status"] === "4"){
					?>
					EL PRODUCTO NO EXISTE.
					<?php
				}else if($_GET["status"] === "5"){
					?>
					EL STOCK DEL PRODUCTO SE ACABÓ.
					<?php
				}?>
				
                <?php
				}
		?>
		<br>
		<form method="post" action="agregar_carrito.php">
			<label for="codigo">Código de barras:</label>
			<input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
		</form>
		<br><br>
		<table class="table table-striped table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>Código</th>
					<th>Descripción</th>
					<th>Precio de venta</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
						$granTotal += $producto->total;
					?>
				<tr>
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->precioVenta ?></td>
					<td><?php echo $producto->cantidad ?></td>
					<td>$<?php echo $producto->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "ventas.php?indice=" . $indice?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<h3>Total: <?php echo $granTotal; ?></h3>
		<form action="./terminarVenta.php" method="POST">
			<input name="total" type="hidden" value="<?php echo $granTotal;?>">
			<button type="submit" class="btn btn-success">Terminar venta</button>
			<a href="cambios/cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
		</form>
	</div>

    <?php
        if(!isset($_GET["indice"])) return;
        $indice = $_GET["indice"];
    
        session_start();
        array_splice($_SESSION["carrito"], $indice, 1);
        header("Location: ventas.php?status=3");


    
    ?>
<?php include_once "includes/footer.php"; ?>