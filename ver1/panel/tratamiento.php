<?php
require_once "../models/tratamiento.php";
$app = new tratamiento();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once "./views/header.php";
switch ($action){
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['tratamiento'] = $_POST['tratamiento'];
            $filas = $app -> create($data);
            $data = $app -> read();
            include_once "views/tratamiento/index.php";
        }
        else {
            include_once "views/tratamiento/_form.php";
        }
        break;
    
    case 'update':
        if (isset($_POST['enviar'])) {
            $id = $_POST['id_tratamiento'];
            $data ['tratamiento'] = $_POST['tratamiento'];
            $row = $app -> update($data, $id);
            $data = $app -> read();
            include_once "views/tratamiento/index.php";
        }
        else {
            $id_tratamiento = $_GET['id'];
            $data = $app -> readOne($id_tratamiento);
            include_once "views/tratamiento/_form_update.php";
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app -> delete($id);
        }
        $data = $app -> read();
        include_once "views/tratamiento/index.php";
        break;
    
    case 'read':
    default:
        $data = $app -> read();
        include_once "views/tratamiento/index.php";
        break;
}
include_once "views/footer.php";
?>