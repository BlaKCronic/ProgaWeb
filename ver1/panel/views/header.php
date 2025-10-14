<?php
// Verificar autenticación
if(!isset($_SESSION['validado']) || $_SESSION['validado'] !== true){
    header("Location: login.php");
    exit();
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Administración - Red de Investigación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-flask me-2"></i>Red de Investigación
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-home me-1"></i>Inicio
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-folder me-1"></i>Catálogos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="institucion.php">
                            <i class="fas fa-university me-2"></i>Instituciones
                        </a></li>
                        <li><a class="dropdown-item" href="tratamiento.php">
                            <i class="fas fa-user-tie me-2"></i>Tratamientos
                        </a></li>
                        <li><a class="dropdown-item" href="investigador.php">
                            <i class="fas fa-users me-2"></i>Investigadores
                        </a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php" target="_blank">
                        <i class="fas fa-external-link-alt me-1"></i>Ver Sitio Público
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <span class="navbar-text me-3">
                    <i class="fas fa-user-circle me-1"></i>
                    <?php echo isset($_SESSION['correo']) ? $_SESSION['correo'] : 'Usuario'; ?>
                </span>
                <a href="login.php?accion=logout" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i>Salir
                </a>
            </div>
        </div>
    </div>
</nav>

<?php
// Mostrar mensajes de sesión
if(isset($_SESSION['success_message'])){
    echo '<div class="container mt-3">';
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $_SESSION['success_message'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    echo '</div>';
    echo '</div>';
    unset($_SESSION['success_message']);
}

if(isset($_SESSION['error_message'])){
    echo '<div class="container mt-3">';
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $_SESSION['error_message'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    echo '</div>';
    echo '</div>';
    unset($_SESSION['error_message']);
}
?>

<div class="container-fluid mt-3">