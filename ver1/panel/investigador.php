<?php
require_once "../models/investigador.php";
include_once "../models/institucion.php";
include_once "../models/tratamiento.php";
$app = new Investigador();
$appInstitucion = new Institucion();
$appTratamiento = new Tratamiento();
$instituciones = $appInstitucion -> read();
$tratamientos = $appTratamiento -> read();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once "./views/header.php";
switch ($action){
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['primer_apellido'] = $_POST['primer_apellido'];
            $data['segundo_apellido'] = $_POST['segundo_apellido'];
            $data['nombre'] = $_POST['nombre'];
            $data['fotografia'] = $_POST['fotografia'];
            $data['id_institucion'] = $_POST['id_institucion'];
            $data['semblanza'] = $_POST['semblanza'];
            $data['id_tratamiento'] = $_POST['id_tratamiento'];
            
            $filas = $app -> create($data);
            $data = $app -> read();
            include_once "views/investigador/index.php";
        }
        else {
            include_once "views/investigador/_form.php";
        }
        break;
    
    case 'update':
        if (isset($_POST['enviar'])) {
            $id = $_POST['id_investigador'];
            $data['primer_apellido'] = $_POST['primer_apellido'];
            $data['segundo_apellido'] = $_POST['segundo_apellido'];
            $data['nombre'] = $_POST['nombre'];
            $data['fotografia'] = $_POST['fotografia'];
            $data['id_institucion'] = $_POST['id_institucion'];
            $data['semblanza'] = $_POST['semblanza'];
            $data['id_tratamiento'] = $_POST['id_tratamiento'];
            
            $row = $app -> update($data, $id);
            $data = $app -> read();
            include_once "views/investigador/index.php";
        }
        else {
            $id_investigador = $_GET['id'];
            $data = $app -> readOne($id_investigador);
            include_once "views/investigador/_form_update.php";
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app -> delete($id);
        }
        $data = $app -> read();
        include_once "views/investigador/index.php";
        break;
    
    case 'read':
    default:
        $data = $app -> read();
        include_once "views/investigador/index.php";
        break;
}
include_once "views/footer.php";
?>