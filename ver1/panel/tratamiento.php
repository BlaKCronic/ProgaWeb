<?php
require_once("../models/tratamiento.php");
$app = new Tratamiento();
$app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['tratamiento'] = $_POST['tratamiento'];
            $row = $app->create($data);
            if ($row){
                $alerta['mensaje'] = "Tratamiento dado de alta correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "El tratamiento no fue dado de alta";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
            $data = $app->read();
            include_once("./views/tratamiento/index.php");
        } else {
            include_once("./views/tratamiento/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['tratamiento'] = $_POST['tratamiento'];
            $id = $_GET['id'];
            $row = $app->update($data, $id); 
            if ($row){
                $alerta['mensaje'] = "Tratamiento modificado correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "El tratamiento no fue modificado";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
            $data = $app->read();
            include_once("./views/tratamiento/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/tratamiento/_form_update.php");
        }
        break;

    case 'delete':
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $row = $app->delete($id);
            if ($row){
                $alerta['mensaje'] = "Tratamiento eliminado correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "El tratamiento no fue eliminado";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
        }
        $data = $app->read();
        include_once("./views/tratamiento/index.php");
        break;
    
    case 'read':
    default:
        $data = $app->read();
        include_once("./views/tratamiento/index.php");
        break;
}
include_once("./views/footer.php");
?>