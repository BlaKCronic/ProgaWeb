<?php 
include_once("../models/sistema.php");
$app = new Sistema();
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

$showAlert = false;
$alerta = [];

switch ($action) {
    case 'logout':
        $app->logout();
        $alerta['mensaje'] = "Usted ha salido correctamente del sistema";
        $alerta['tipo'] = "success";
        $showAlert = true;
        include_once("./views/login/header.php");
        if ($showAlert) {
            include_once("./views/alert.php");
        }
        include_once("./views/login/login.php");
        include_once("./views/login/footer.php");
        break;

    case 'recuperar':
        include_once("./views/login/header.php");
        include_once("./views/login/recuperar.php");
        include_once("./views/login/footer.php");
        break;

    case 'cambio':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $cambio = $app->cambiarContraseña($data);
            if($cambio){
                $alerta['mensaje'] = "Se envió un enlace para cambiar la contraseña al correo indicado.";
                $alerta['tipo'] = "success";
                $showAlert = true;
                include_once("./views/login/header.php");
                if ($showAlert) {
                    include_once("./views/alert.php");
                }
                include_once("./views/login/login.php");
                include_once("./views/login/footer.php");
            } else {
                $alerta['mensaje'] = "No se pudo generar el token. Verifique el correo e intente de nuevo.";
                $alerta['tipo'] = "danger";
                $showAlert = true;
                include_once("./views/login/header.php");
                if ($showAlert) {
                    include_once("./views/alert.php");
                }
                include_once("./views/login/recuperar.php");
                include_once("./views/login/footer.php");
            }
        } else {
            include_once("./views/login/header.php");
            include_once("./views/login/recuperar.php");
            include_once("./views/login/footer.php");
        }
        break;

    case 'token':
        if (isset($_GET['token']) && isset($_GET['correo'])) {
            include_once("./views/login/header.php");
            include_once("./views/login/token.php");
            include_once("./views/login/footer.php");
        } else {
            $alerta['mensaje'] = "Token o correo no válido";
            $alerta['tipo'] = "danger";
            $showAlert = true;
            include_once("./views/login/header.php");
            if ($showAlert) {
                include_once("./views/alert.php");
            }
            include_once("./views/login/login.php");
            include_once("./views/login/footer.php");
        }
        break;

    case 'reestablecer':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $reestablecer = $app->restablecerContraseña($data);
            if($reestablecer){
                $alerta['mensaje'] = "Se ha restablecido la contraseña correctamente.";
                $alerta['tipo'] = "success";
                $showAlert = true;
                include_once("./views/login/header.php");
                if ($showAlert) {
                    include_once("./views/alert.php");
                }
                include_once("./views/login/login.php");
                include_once("./views/login/footer.php");
            } else {
                $alerta['mensaje'] = "Error al restablecer la contraseña. Verifique los datos e intente de nuevo.";
                $alerta['tipo'] = "danger";
                $showAlert = true;
                include_once("./views/login/header.php");
                if ($showAlert) {
                    include_once("./views/alert.php");
                }
                include_once("./views/login/token.php");
                include_once("./views/login/footer.php");
            }
        } else {
            include_once("./views/login/header.php");
            include_once("./views/login/token.php");
            include_once("./views/login/footer.php");
        }
        break;
        
    case 'login':
        if (isset($_POST['enviar'])) {
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $login = $app->login($correo, $contrasena);
            if ($login) {
                header("Location: index.php");
                exit();
            } else {
                $alerta['mensaje'] = "Correo o contraseña incorrecta";
                $alerta['tipo'] = "danger";
                $showAlert = true;
                include_once("./views/login/header.php");
                if ($showAlert) {
                    include_once("./views/alert.php");
                }
                include_once("./views/login/login.php");
                include_once("./views/login/footer.php");
            }
        } else {
            include_once("./views/login/header.php");
            include_once("./views/login/login.php");
            include_once("./views/login/footer.php");
        }
        break;
        
    default:
        include_once("./views/login/header.php");
        include_once("./views/login/login.php");
        include_once("./views/login/footer.php");
        break;
}
?>