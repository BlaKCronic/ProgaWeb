<?php
include_once("../models/sistema.php");
$sistema = new Sistema();
$accion = isset($_POST['accion']) ? $_POST['accion'] : (isset($_GET['accion']) ? $_GET['accion'] : 'login');

include_once("views/login/header.php");

switch ($accion) {
    case 'logout':
        $sistema->logout();
        $alerta['mensaje'] = "Sesión cerrada correctamente";
        $alerta['tipo'] = "success";
        include_once("views/alert.php");
        include_once("views/login/login.php");
        break;
    
    case 'login':
        if (isset($_POST['enviar'])){
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $login = $sistema->login($correo, $contrasena);
            
            if ($login){
                header("Location: index.php");
                exit();
            } else {
                $alerta['mensaje'] = "Correo o contraseña incorrectos";
                $alerta['tipo'] = "danger";
                include_once("views/alert.php");
                include_once("views/login/login.php");
            }
        } else {
            include_once("views/login/login.php");
        }
        break;

    default:
        include_once("views/login/login.php");
        break;
}

include_once("views/login/footer.php");
?>