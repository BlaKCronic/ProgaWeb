<?php
require_once("../models/institucion.php");
$app = new Institucion();
$app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['institucion'] = $_POST['institucion'];
            $row = $app->create($data);
            if ($row){
                $alerta['mensaje'] = "Institución dada de alta correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "La institución no fue dada de alta";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
            $data = $app->read();
            include_once("./views/institucion/index.php");
        } else {
            include_once("./views/institucion/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['institucion'] = $_POST['institucion'];
            $id = $_GET['id'];
            $row = $app->update($data, $id); 
            if ($row){
                $alerta['mensaje'] = "Institución modificada correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "La institución no fue modificada";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
            $data = $app->read();
            include_once("./views/institucion/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/institucion/_form_update.php");
        }
        break;

    case 'delete':
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $row = $app->delete($id);
            if ($row){
                $alerta['mensaje'] = "Institución eliminada correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "La institución no fue eliminada";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
        }
        $data = $app->read();
        include_once("./views/institucion/index.php");
        break;
    
    case 'read':
    default:
        $data = $app->read();
        include_once("./views/institucion/index.php");
        break;
}
include_once("./views/footer.php");
?>