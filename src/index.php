<?php include_once "includes/header.php";
require "../conexion.php";
$usuarios = mysqli_query($conexion, "SELECT * FROM usuario");
$totalU= mysqli_num_rows($usuarios);
$productos = mysqli_query($conexion, "SELECT * FROM productos");
$totalP = mysqli_num_rows($productos);
$ventas = mysqli_query($conexion, "SELECT * FROM ventas");
$totalV = mysqli_num_rows($ventas);
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray">Abarrotes DonChuy || Administracion.</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <a class="col-xl-3 col-md-6 mb-4" href="usuarios.php">
            <div class="card border-left-primary shadow h-100 py-2 bg-warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Usuarios</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?php echo $totalU; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <a class="col-xl-3 col-md-6 mb-4" href="productos.php">
            <div class="card border-left-info shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Productos</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-white"><?php echo $totalP; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <a class="col-xl-3 col-md-6 mb-4" href="lista_ventas.php">
            <div class="card border-left-warning bg-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Ventas</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?php echo $totalV; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

<?php include_once "includes/footer.php"; ?>