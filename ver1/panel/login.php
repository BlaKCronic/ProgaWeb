<?php
include_once("../models/sistema.php");
include_once("login/header.php");
include_once("login/footer.php");
$sistema = new Sistema();
$accion = isset($_POST['accion']) ? $_POST['accion'] : 'login';
switch ($accion) {
    case 'logout':
        $sistema->logout();
        break;
    
    case 'login':
        if (isset($_POST['enviar'])){
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $login = $sistema->login($correo, $contrasena);
            
            if ($login){
                header("Location: index.php");
            } else {
                $alerta['mensaje'] = "Correo o contraseña incorrectos";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
                include_once("./views/login/login.php");
            }
        } else {
            include_once("./views/login/login.php");
        }
        break;

    default:
        include_once("./views/login/login.php");
        break;

}
?>