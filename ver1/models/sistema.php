<?php
session_start();
class Sistema{
    var $_DNS = "mysql:host=mariadb;dbname=database";
    var $_USER = "user";
    var $_PASSWORD = "password";
    var $_BD = null;
    
    private $allowed_image_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    private $max_file_size = 5242880;
    private $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    function conect(){
        $this -> _BD = new PDO($this -> _DNS, $this -> _USER, $this -> _PASSWORD);
    }

    function cargarFotografia($carpeta){
        $response = [
            'success' => false,
            'filename' => null,
            'error' => ''
        ];

        if(!isset($_FILES['fotografia']) || $_FILES['fotografia']['error'] === UPLOAD_ERR_NO_FILE){
            $response['error'] = 'No se ha seleccionado ningún archivo';
            return $response;
        }

        if($_FILES['fotografia']['error'] !== UPLOAD_ERR_OK){
            $response['error'] = $this->getUploadErrorMessage($_FILES['fotografia']['error']);
            return $response;
        }

        if($_FILES['fotografia']['size'] > $this->max_file_size){
            $response['error'] = 'El archivo excede el tamaño máximo permitido de ' . ($this->max_file_size / 1048576) . 'MB';
            return $response;
        }

        if($_FILES['fotografia']['size'] == 0){
            $response['error'] = 'El archivo está vacío';
            return $response;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['fotografia']['tmp_name']);
        finfo_close($finfo);

        if(!in_array($mime_type, $this->allowed_image_types)){
            $response['error'] = 'Tipo de archivo no permitido. Solo se aceptan imágenes JPG, PNG, GIF y WEBP';
            return $response;
        }

        $original_filename = $_FILES['fotografia']['name'];
        $file_extension = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
        
        if(!in_array($file_extension, $this->allowed_extensions)){
            $response['error'] = 'Extensión de archivo no permitida';
            return $response;
        }

        $image_info = @getimagesize($_FILES['fotografia']['tmp_name']);
        if($image_info === false){
            $response['error'] = 'El archivo no es una imagen válida';
            return $response;
        }

        $unique_filename = $this->generateUniqueFilename($original_filename);
        
        $safe_filename = $this->sanitizeFilename($unique_filename);

        $upload_path = '../img/' . $carpeta . '/';
        if(!file_exists($upload_path)){
            if(!mkdir($upload_path, 0755, true)){
                $response['error'] = 'No se pudo crear el directorio de destino';
                return $response;
            }
        }

        if(!is_writable($upload_path)){
            $response['error'] = 'No hay permisos de escritura en el directorio de destino';
            return $response;
        }

        $destination = $upload_path . $safe_filename;
        if(move_uploaded_file($_FILES['fotografia']['tmp_name'], $destination)){
            chmod($destination, 0644);
            
            $response['success'] = true;
            $response['filename'] = $safe_filename;
        } else {
            $response['error'] = 'Error al mover el archivo al destino final';
        }

        return $response;
    }

    private function generateUniqueFilename($original_filename){
        $extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        $filename_without_ext = pathinfo($original_filename, PATHINFO_FILENAME);
        
        $clean_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename_without_ext);
        $clean_name = substr($clean_name, 0, 50);
        
        $unique_name = $clean_name . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
        
        return $unique_name;
    }

    private function sanitizeFilename($filename){
        $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
        $filename = preg_replace('/\.+/', '.', $filename);
        $filename = ltrim($filename, '.');
        
        return $filename;
    }

    private function getUploadErrorMessage($error_code){
        switch($error_code){
            case UPLOAD_ERR_INI_SIZE:
                return 'El archivo excede el tamaño máximo permitido por el servidor';
            case UPLOAD_ERR_FORM_SIZE:
                return 'El archivo excede el tamaño máximo permitido por el formulario';
            case UPLOAD_ERR_PARTIAL:
                return 'El archivo se subió parcialmente';
            case UPLOAD_ERR_NO_FILE:
                return 'No se subió ningún archivo';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Falta el directorio temporal';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Error al escribir el archivo en disco';
            case UPLOAD_ERR_EXTENSION:
                return 'Una extensión de PHP detuvo la subida del archivo';
            default:
                return 'Error desconocido al subir el archivo';
        }
    }
    function eliminarArchivo($carpeta, $filename){
        if(empty($filename)){
            return false;
        }

        $filepath = '../img/' . $carpeta . '/' . $filename;
        
        $real_path = realpath($filepath);
        $allowed_path = realpath('../img/' . $carpeta . '/');
        
        if($real_path && $allowed_path && strpos($real_path, $allowed_path) === 0){
            if(file_exists($filepath) && is_file($filepath)){
                return unlink($filepath);
            }
        }
        
        return false;
    }

    function validarArchivoAntesDeCarga($file_data){
        $response = [
            'valid' => false,
            'errors' => []
        ];

        if($file_data['size'] > $this->max_file_size){
            $response['errors'][] = 'El archivo excede el tamaño máximo de ' . ($this->max_file_size / 1048576) . 'MB';
        }

        $extension = strtolower(pathinfo($file_data['name'], PATHINFO_EXTENSION));
        if(!in_array($extension, $this->allowed_extensions)){
            $response['errors'][] = 'Extensión no permitida. Solo: ' . implode(', ', $this->allowed_extensions);
        }

        $response['valid'] = empty($response['errors']);
        return $response;
    }

    function getFileUploadLimits(){
        return [
            'max_size' => $this->max_file_size,
            'max_size_mb' => $this->max_file_size / 1048576,
            'allowed_types' => $this->allowed_image_types,
            'allowed_extensions' => $this->allowed_extensions
        ];
    }

    function login($correo, $contrasena){
    $contrasena = md5($contrasena);
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $this->conect();
        $sql = "SELECT * FROM usuario WHERE correo = :correo AND contrasena = :contrasena";
        $stmt = $this->_BD->prepare($sql);
        $stmt->bindParam(":correo", $correo);
        $stmt->bindParam(":contrasena", $contrasena);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['validado'] = true;
            $_SESSION['correo'] = $correo;
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $roles = $this->getroles($correo);
            $permisos = $this->getpermisos($correo);
            $_SESSION['roles'] = $roles;
            $_SESSION['permisos'] = $permisos;
            return true;
        }
    }
    return false;
}

function logout(){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION);
    session_destroy();
}

function getroles($correo){
    $this->conect();
    $sql = "SELECT r.rol FROM rol r
            JOIN usuario_rol ur ON r.id_rol = ur.id_rol
            JOIN usuario u ON ur.id_usuario = u.id_usuario
            WHERE u.correo = :correo";
    $stmt = $this->_BD->prepare($sql);
    $stmt->bindParam(":correo", $correo);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function getpermisos($correo){
    $this->conect();
    $sql = "SELECT DISTINCT p.privilegio FROM privilegio p
            JOIN rol_privilegio rp ON p.id_privilegio = rp.id_privilegio
            JOIN rol r ON rp.id_rol = r.id_rol
            JOIN usuario_rol ur ON r.id_rol = ur.id_rol
            JOIN usuario u ON ur.id_usuario = u.id_usuario
            WHERE u.correo = :correo";
    $stmt = $this->_BD->prepare($sql);
    $stmt->bindParam(":correo", $correo);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
}
?>