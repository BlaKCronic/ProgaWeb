<?php
session_start();
class Sistema{
    var $_DSN = "mysql:host=mariadb;dbname=database";
    var $_USER = "user";
    var $_PASSWORD = "password";
    var $_DB = null;
    
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
                WHERE correo = :correo";
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
                WHERE correo = :correo";
        $stmt = $this->_DB->prepare($sql);
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
                $permisos[] = $fila['privilegio'];
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
            $alerta['mensaje'] = "Usted no tiene el rol adecuado";
            $alerta['tipo'] = "danger";
            include_once("./views/error.php");
            die();
        }
    }
}
?>