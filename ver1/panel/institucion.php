<?php
require_once "../models/institucion.php";
$app = new Institucion();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
switch ($action){
    case 'create':
        $data['institucion'] = $_POST['institucion'];
        $data['logotipo'] = $_POST['logotipo'];
        $filas = $app -> create($data);
        echo $filas;
        break;
    
    case 'update':
        $data['institucion'] = $_POST['institucion'];
        $data['logotipo'] = $_POST['logotipo'];
        $id = $_POST['id_institucion'];
        $filas = $app -> update($data, $id);
        echo $filas;
        break;

    case 'delete':
        $id = $_GET['id_institucion'];
        $filas = $app -> delete($id);
        echo $filas;
        break;
    
    case 'read':
    default:
        $data = $app -> read();
        include_once "../views/institucion/index.php";
        break;
}
?>