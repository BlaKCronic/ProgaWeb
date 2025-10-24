<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../models/investigador.php");
require_once("../models/institucion.php");
require_once("../models/tratamiento.php");
$appInstitucion = new Institucion();
$appTratamiento = new Tratamiento();  
$instituciones = $appInstitucion->read();
$tratamientos = $appTratamiento->read();
$app = new Investigador();
$app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            
            $errores = array();
            if(empty($data['primer_apellido'])) $errores[] = "Primer apellido requerido";
            if(empty($data['segundo_apellido'])) $errores[] = "Segundo apellido requerido";
            if(empty($data['nombre'])) $errores[] = "Nombre requerido";
            if(empty($data['correo'])) $errores[] = "Correo requerido";
            if(empty($data['password'])) $errores[] = "Contraseña requerida";
            if(empty($data['id_institucion'])) $errores[] = "Institución requerida";
            if(empty($data['id_tratamiento'])) $errores[] = "Tratamiento requerido";
            
            if(!isset($_FILES['fotografia']) || $_FILES['fotografia']['error'] != 0){
                $errores[] = "Fotografía requerida";
            }
            
            if(count($errores) > 0){
                $alerta['mensaje'] = "Errores: " . implode(", ", $errores);
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
                include_once("./views/investigador/_form.php");
            } else {
                $row = $app->create($data);
                if ($row){
                    $alerta['mensaje'] = "Investigador dado de alta correctamente";
                    $alerta['tipo'] = "success";
                    include_once("./views/alert.php");
                } else {
                    $alerta['mensaje'] = "Error: El investigador no fue dado de alta. Revisa los logs del servidor.";
                    $alerta['tipo'] = "danger";
                    include_once("./views/alert.php");
                }
                $data = $app->read();
                include_once("./views/investigador/index.php");
            }
        } else {
            include_once("./views/investigador/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $id = $_GET['id'];
            $row = $app->update($data, $id); 
            if ($row){
                $alerta['mensaje'] = "Investigador modificado correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "El investigador no fue modificado";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
            $data = $app->read();
            include_once("./views/investigador/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/investigador/_form_update.php");
        }
        break;

    case 'delete':
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $row = $app->delete($id);
            if ($row){
                $alerta['mensaje'] = "Investigador eliminado correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "El investigador no fue eliminado";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
        }
        $data = $app->read();
        include_once("./views/investigador/index.php");
        break;
    
    case 'read':
    default:
        $data = $app->read();
        include_once("./views/investigador/index.php");
        break;
}
include_once("./views/footer.php");
?>