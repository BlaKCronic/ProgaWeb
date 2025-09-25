<?php
require_once "../models/institucion.php";
$app = new Institucion();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once "./views/header.php";
switch ($action){
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['institucion'] = $_POST['institucion'];
            $data['logotipo'] = $_POST['logotipo'];
            $filas = $app -> create($data);
            $data = $app -> read();
            include_once "views/institucion/index.php";
        }
        else {
            include_once "views/institucion/_form.php";
        }
        break;
    
    case 'update':
        if (isset($_POST['enviar'])) {
            $id = $_POST['id_institucion'];
            $data ['institucion'] = $_POST['institucion'];
            $data ['logotipo'] = $_POST['logotipo'];
            $row = $app -> update($data, $id);
            $data = $app -> read();
            include_once "views/institucion/index.php";
        }
        else {
            $id_institucion = $_GET['id_institucion'];
            $data = $app -> readOne($id_institucion);
            include_once "views/institucion/_form_update.php";
        }
        break;

    case 'delete':
        if (isset($_GET['id_institucion'])) {
            $id = $_GET['id_institucion'];
            $filas = $app -> delete($id);
        }
        $data = $app -> read();
        include_once "views/institucion/index.php";
        break;
    
    case 'read':
    default:
        $data = $app -> read();
        include_once "views/institucion/index.php";
        break;
}
include_once "views/footer.php";
?>