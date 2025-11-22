<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../models/institucion.php';

$app = new Institucion();
$action = $_SERVER['REQUEST_METHOD'];
$data = array();
$id = isset($_GET['id']) ? $_GET['id'] : null;

function convertirImagenABase64($file) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    
    $tiposPermitidos = [
        'image/jpeg' => 'jpeg',
        'image/jpg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
        'image/svg+xml' => 'svg+xml'
    ];
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!array_key_exists($mimeType, $tiposPermitidos)) {
        return null;
    }
    
    $maxSize = 5 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        return null;
    }
    
    $contenido = file_get_contents($file['tmp_name']);
    if ($contenido === false) {
        return null;
    }
    
    $base64 = base64_encode($contenido);
    
    return 'data:' . $mimeType . ';base64,' . $base64;
}

switch ($action) {
    case 'POST':
        $data = $_POST;
        
        if (isset($_FILES['logotipo']) && $_FILES['logotipo']['error'] === UPLOAD_ERR_OK) {
            $logotipoBase64 = convertirImagenABase64($_FILES['logotipo']);
            if ($logotipoBase64 !== null) {
                $data['logotipo_base64'] = $logotipoBase64;
            } else {
                echo json_encode([
                    'error' => true,
                    'mensaje' => 'Error al procesar la imagen. Verifique el formato (jpg, png, gif, webp, svg) y tamaño (máx 5MB).'
                ], JSON_PRETTY_PRINT);
                exit;
            }
        }
        if (isset($data['logotipo_base64']) && !empty($data['logotipo_base64'])) {
            if (!preg_match('/^data:image\/(jpeg|jpg|png|gif|webp|svg\+xml);base64,/', $data['logotipo_base64'])) {
                echo json_encode([
                    'error' => true,
                    'mensaje' => 'Formato de imagen base64 no válido.'
                ], JSON_PRETTY_PRINT);
                exit;
            }
        }
        
        if (!is_null($id)) {
            $row = $app->updateWithBase64($data, $id);
            $data['mensaje'] = 'Registro actualizado correctamente';
        } else {
            $row = $app->createWithBase64($data);
            $data['mensaje'] = 'Registro creado correctamente';
        }
        
        if ($row) {
            $data['success'] = true;
            $data['affected_rows'] = $row;
        } else {
            $data['success'] = false;
            $data['mensaje'] = 'No se pudo completar la operación';
        }
        break;
        
    case 'DELETE':
        if (!is_null($id)) {
            $row = $app->delete($id);
            if ($row) {
                $data['success'] = true;
                $data['mensaje'] = 'Registro eliminado correctamente';
            } else {
                $data['success'] = false;
                $data['mensaje'] = 'No se pudo eliminar el registro';
            }
        } else {
            $data['success'] = false;
            $data['mensaje'] = 'Falta el identificador del registro a eliminar';
        }
        break;
        
    case 'GET':
    default:
        if (is_null($id)) {
            $data = $app->read();
        } else {
            $data = $app->readOne($id);
        }
        break;
}

print(json_encode($data, JSON_PRETTY_PRINT));
?>