<?php
session_start();

if(!isset($_SESSION['validado']) || $_SESSION['validado'] !== true){
    header("Location: login.php");
    exit();
}

include_once "./views/header.php";
?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Panel de Administración</h1>
            <div class="alert alert-success" role="alert">
                Bienvenido, <?php echo $_SESSION['correo']; ?>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-university fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Instituciones</h5>
                    <p class="card-text">Gestiona las instituciones colaboradoras</p>
                    <a href="institucion.php" class="btn btn-primary">Administrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-user-tie fa-3x mb-3 text-success"></i>
                    <h5 class="card-title">Tratamientos</h5>
                    <p class="card-text">Configura los tratamientos académicos</p>
                    <a href="tratamiento.php" class="btn btn-success">Administrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-users fa-3x mb-3 text-warning"></i>
                    <h5 class="card-title">Investigadores</h5>
                    <p class="card-text">Gestiona los miembros de la red</p>
                    <a href="investigador.php" class="btn btn-warning">Administrar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 text-center">
            <a href="login.php?accion=logout" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>
</div>

<?php
include_once "views/footer.php";
?>