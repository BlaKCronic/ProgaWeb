<?php
require_once("../models/institucion.php");
$app = new Institucion();
$app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once("./views/header.php");

function convertirImagenABase64($file) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    
    $tiposPermitidos = [
        'image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'
    ];
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mimeType, $tiposPermitidos)) {
        return null;
    }
    
    if ($file['size'] > 5 * 1024 * 1024) {
        return null;
    }
    
    $contenido = file_get_contents($file['tmp_name']);
    if ($contenido === false) {
        return null;
    }
    
    return 'data:' . $mimeType . ';base64,' . base64_encode($contenido);
}

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['institucion'] = $_POST['institucion'];
            
            if (isset($_FILES['logotipo']) && $_FILES['logotipo']['error'] === UPLOAD_ERR_OK) {
                $logotipoBase64 = convertirImagenABase64($_FILES['logotipo']);
                if ($logotipoBase64 !== null) {
                    $data['logotipo_base64'] = $logotipoBase64;
                    $row = $app->createWithBase64($data);
                } else {
                    $alerta['mensaje'] = "Error al procesar la imagen. Verifique el formato y tamaño.";
                    $alerta['tipo'] = "danger";
                    include_once("./views/alert.php");
                    include_once("./views/institucion/_form.php");
                    include_once("./views/footer.php");
                    exit;
                }
            } else {
                $alerta['mensaje'] = "Debe seleccionar un logotipo para la institución.";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
                include_once("./views/institucion/_form.php");
                include_once("./views/footer.php");
                exit;
            }
            
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
            
            if (isset($_FILES['logotipo']) && $_FILES['logotipo']['error'] === UPLOAD_ERR_OK) {
                $logotipoBase64 = convertirImagenABase64($_FILES['logotipo']);
                if ($logotipoBase64 !== null) {
                    $data['logotipo_base64'] = $logotipoBase64;
                } else {
                    $alerta['mensaje'] = "Error al procesar la imagen. Verifique el formato y tamaño.";
                    $alerta['tipo'] = "danger";
                    include_once("./views/alert.php");
                    $data = $app->readOne($id);
                    include_once("./views/institucion/_form_update.php");
                    include_once("./views/footer.php");
                    exit;
                }
            }
            $row = $app->updateWithBase64($data, $id); 
            if ($row){
                $alerta['mensaje'] = "Institución modificada correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "La institución no fue modificada";
                $alerta['tipo'] = "warning";
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