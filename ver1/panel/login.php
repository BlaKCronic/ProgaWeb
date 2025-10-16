<?php
include_once("../models/sistema.php");
$sistema = new Sistema();
$accion = isset($_POST['accion']) ? $_POST['accion'] : (isset($_GET['accion']) ? $_GET['accion'] : 'login');

if ($accion === 'logout') {
    $sistema->logout();
    header("Location: login.php?mensaje=sesion_cerrada");
    exit();
}

if ($accion === 'login' && isset($_POST['enviar'])) {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $login = $sistema->login($correo, $contrasena);
    
    if ($login) {
        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php?error=credenciales");
        exit();
    }
}

include_once("views/login/header.php");

if (isset($_GET['mensaje'])) {
    if ($_GET['mensaje'] === 'sesion_cerrada') {
        $alerta['mensaje'] = "Sesión cerrada correctamente";
        $alerta['tipo'] = "success";
        include_once("views/alert.php");
    }
}

if (isset($_GET['error'])) {
    if ($_GET['error'] === 'credenciales') {
        $alerta['mensaje'] = "Correo o contraseña incorrectos";
        $alerta['tipo'] = "danger";
        include_once("views/alert.php");
    }
}

include_once("views/login/login.php");

include_once("views/login/footer.php");
?>