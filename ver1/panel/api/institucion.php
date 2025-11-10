<?php
//header('Content-Type: application/json');
require_once __DIR__ . '/../../models/institucion.php';
$app = new Institucion();
$app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['institucion'] = $_POST['institucion'];
            $row = $app->create($data);
            if ($row){
                $alerta['mensaje'] = "Institución dada de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La institución no fue dada de alta";
                $alerta['tipo'] = "danger";
            }
            $data = $app->read();
        } else {
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
            } else {
                $alerta['mensaje'] = "La institución no fue modificada";
                $alerta['tipo'] = "danger";            }
            $data = $app->read();
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
        }
        break;

    case 'delete':
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $row = $app->delete($id);
            if ($row){
                $alerta['mensaje'] = "Institución eliminada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La institución no fue eliminada";
                $alerta['tipo'] = "danger";
            }
        }
        $data = $app->read();
        break;
    
    case 'read':
    default:
        $data = $app->read();
        print_r($data);
        die();
        break;
}
?>