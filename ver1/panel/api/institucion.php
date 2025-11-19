<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../models/institucion.php';
$app = new Institucion();
//$app->checarRol('Administrador');
$action = $_SERVER['REQUEST_METHOD'];
$data = array();
//print_r($_POST);
//die();
$id = isset($_GET['id']) ? $_GET['id'] : null;
switch ($action) {
    case 'POST':
        $data = $_POST;
        if (!is_null($id)){
            $row = $app -> update($data, $id);
            $data['mensaje'] = 'Registro actualizado correctamente';
        }else{
            $row = $app -> create($data);
            $data['mensaje'] = 'Registro creado correctamente';
        }
        break;
    case 'DELETE':
        if (!is_null($id)) {
            $row = $app->delete($id);
            if ($row) {
                $data['mensaje'] = 'Registro eliminado correctamente';
            }else {
                $data['mensaje'] = 'No se pudo eliminar el registro';
            }
        }else {
            $data['mensaje'] = 'Falta el identificador del registro a eliminar';
        }
        break;
    case 'GET':
    default:
    if (is_null($id)){
            $data = $app->read();
        } else {
            $data = $app->readOne($id);
        }
        break;
}
print(json_encode($data, JSON_PRETTY_PRINT));
?>