<?php 
include_once("../models/sistema.php");
include_once("../models/institucion.php");
$app = new Sistema();
$appInstitucion = new Institucion();
if(!isset($_SESSION['validado']) || $_SESSION['validado'] !== true){
    header("Location: login.php");
    exit();
}

$roles = isset($_SESSION['roles']) ? $_SESSION['roles'] : array();
if(count($roles) == 0){
    $alerta['mensaje'] = "No tiene roles asignados. Contacte al administrador del sistema.";
    $alerta['tipo'] = "danger";
    include_once("./views/login/header.php");
    include_once("./views/alert.php");
    include_once("./views/login/footer.php");
    exit();
}

include_once("./views/header.php");
$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';

switch ($action) {
    case 'dashboard':
    default:
    $datosInstitucion = $appInstitucion->reporteInstitucion();
        include_once("./views/index/index.php");
        break;
}

include_once("./views/footer.php");
?>