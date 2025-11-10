<?php
class Sistema{
    var $_DSN = "mysql:host=mariadb;dbname=database";
    var $_USER = "user";
    var $_PASSWORD = "password";
    var $_DB = null;
    
    function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    function connect(){
        $this->_DB = new PDO($this->_DSN, $this->_USER, $this->_PASSWORD);
    }

    function login($correo, $contrasena){
        $contrasena = md5($contrasena);
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->connect();
            $sql = "SELECT * FROM usuario WHERE correo = :correo AND contrasena = :contrasena";
            $stmt = $this->_DB->prepare($sql);
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmt->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['validado'] = true;
                $_SESSION['correo'] = $correo;
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $roles = $this->getroles($correo);
                $permisos = $this->getPermisos($correo);
                $_SESSION['roles'] = $roles;
                $_SESSION['permisos'] = $permisos;
                return true;
            }
        }
        return false;
    }

    function logout(){
        unset($_SESSION);
        session_destroy();
    }

    function getroles($correo){
        $roles = array();
        $this->connect();
        $sql = "SELECT r.rol FROM usuario u 
                JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                JOIN rol r ON ur.id_rol = r.id_rol 
                WHERE u.correo = :correo";
        $stmt = $this->_DB->prepare($sql);
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
                $roles[] = $fila['rol'];
            }
        }
        return $roles;
    }

    function getPermisos($correo){
        $permisos = array();
        $this->connect();
        $sql = "SELECT DISTINCT p.privilegio FROM usuario u 
                JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                LEFT JOIN rol r ON ur.id_rol = r.id_rol
                LEFT JOIN rol_privilegio rp ON r.id_rol = rp.id_rol
                LEFT JOIN privilegio p ON rp.id_privilegio = p.id_privilegio
                WHERE u.correo = :correo";
        $stmt = $this->_DB->prepare($sql);
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($fila['privilegio'] != null){
                    $permisos[] = $fila['privilegio'];
                }
            }
        }
        return $permisos;
    }

    function cargarFotografia($carpeta, $nombre){
        $tipos = array("image/jpg", "image/jpeg", "image/png", "image/gif");
        $maximo = 1000 * 1024;
        if(isset($_FILES[$nombre])){
            $imagen = $_FILES[$nombre];
            if($imagen["error"] == 0){
                if(in_array($imagen["type"], $tipos)){
                    if($imagen["size"] <= $maximo){
                        $n = rand(1, 999999);
                        $nombreArchivo = md5($imagen["name"].$imagen["size"].$n);
                        $extension = explode(".", $imagen["name"]);
                        $extension = $extension[count($extension)-1];
                        $nombreArchivo .= ".".$extension;
                        $rutaFinal = '../img/'.$carpeta.'/'.$nombreArchivo;
                        if(!file_exists($rutaFinal)){
                            if(move_uploaded_file($imagen["tmp_name"], $rutaFinal)){
                                return $nombreArchivo;
                            }
                        }
                    }
                }
            }
        }
        return null;
    }

    function checarRol($rol){
        $roles = isset($_SESSION['roles']) ? $_SESSION['roles'] : array();
        if(!in_array($rol, $roles)){
            $alerta['mensaje'] = "Usted no tiene el rol adecuado. Roles actuales: " . implode(", ", $roles);
            $alerta['tipo'] = "danger";
            $errorView = dirname(__DIR__) . '/views/error.php';
            if (file_exists($errorView)) {
                include_once $errorView;
            } elseif (file_exists(__DIR__ . '/views/error.php')) {
                include_once __DIR__ . '/views/error.php';
            } else {
                echo '<h1>Error</h1><p>No se encontró la vista de error. ' . htmlspecialchars($alerta['mensaje']) . '</p>';
            }
            die();
        }
    }

    function enviarCorreo($para, $asunto, $mensaje, $nombre = null){
        require_once __DIR__ . '/../vendor/autoload.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = '22030935@itcelaya.edu.mx';
        $mail->Password = '3H2ULu9Z5a3FLsT7Q23ijg';
        $mail->setFrom('22030935@itcelaya.edu.mx', 'Christian Eduardo Ponce Gonzalez');
        $mail->addAddress($para, $nombre ? $nombre : 'Red de Investigación');
        $mail->Subject = $asunto;
        $mail->msgHTML($mensaje);
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

    function cambiarContraseña($data){
        if(!filter_var($data['correo'], FILTER_VALIDATE_EMAIL)){
            return false;
        }
        $this->connect();
        $token = bin2hex(random_bytes(16));
        $token = md5($token);
        $token = $token.md5('CruzAzulCampeon');
        $sql = "UPDATE usuario SET token = :token
                WHERE correo = :correo";
        $sth = $this->_DB->prepare($sql);
        $sth->bindParam(":token", $token, PDO::PARAM_STR);
        $sth->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $sth->execute();
        if($sth->rowCount() > 0){
            $para = $data['correo'];
            $asunto = "Recuperación de Contraseña Red de Investigación";
            $mensaje = "Para cambiar su contraseña ingrese al siguiente link:
                <br><br><a href='http://localhost:8080/proyecto/ProgaWeb/ver1/panel/login.php?action=token&token=". $token. 
                "&correo=". $data['correo']. "'>Recuperar Contraseña</a>
                <br><br>Atentamente, Administrador de Red de Investigación.";
            $mail = $this->enviarCorreo($para, $asunto, $mensaje);
            return true;
        } else{
            return false;
        }
    }

    function restablecerContraseña($data){
        if(!filter_var($data['correo'], FILTER_VALIDATE_EMAIL)){
            return false;
        }
        $this->connect();
        $contrasena = md5($data['contrasena']);
        $sql = "UPDATE usuario SET contrasena = :contrasena, token = NULL
                WHERE correo = :correo AND token = :token";
        $sth = $this->_DB->prepare($sql);
        $sth->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
        $sth->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $sth->bindParam(":token", $data['token'], PDO::PARAM_STR);
        $sth->execute();
        if($sth->rowCount() > 0){
            return true;
        } else{
            return false;
        }
    }
}
?>