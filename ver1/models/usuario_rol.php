<?php
require_once "sistema.php";
class UsuarioRol extends Sistema {
    
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
    
    function getRolesByUsuario($id_usuario){
        $this->connect();
        $sql = "SELECT r.* FROM rol r
                INNER JOIN usuario_rol ur ON r.id_rol = ur.id_rol
                WHERE ur.id_usuario = :id_usuario
                ORDER BY r.id_rol";
        $sth = $this->_DB->prepare($sql);
        $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll();
    }
    
    function getUsuariosConRoles(){
        $this->connect();
        $sql = "SELECT u.id_usuario, u.correo,
                GROUP_CONCAT(r.rol SEPARATOR ', ') as roles,
                GROUP_CONCAT(r.id_rol) as ids_roles
                FROM usuario u
                LEFT JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                LEFT JOIN rol r ON ur.id_rol = r.id_rol
                GROUP BY u.id_usuario, u.correo
                ORDER BY u.id_usuario";
        $sth = $this->_DB->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
    
    function asignarRol($id_usuario, $id_rol){
        $this->connect();
        $this->_DB->beginTransaction();
        try {
            $sql = "SELECT * FROM usuario_rol 
                    WHERE id_usuario = :id_usuario AND id_rol = :id_rol";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
            $sth->execute();
            
            if($sth->rowCount() > 0){
                $this->_DB->rollback();
                return 0;
            }
            
            $sql = "INSERT INTO usuario_rol (id_usuario, id_rol) 
                    VALUES (:id_usuario, :id_rol)";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
            $sth->execute();
            $affected_rows = $sth->rowCount();
            $this->_DB->commit();
            return $affected_rows;
        } catch (Exception $ex) {
            $this->_DB->rollback();
            error_log("Error al asignar rol: " . $ex->getMessage());
            return null;
        }
    }
    
    function quitarRol($id_usuario, $id_rol){
        $this->connect();
        $this->_DB->beginTransaction();
        try {
            $sql = "DELETE FROM usuario_rol 
                    WHERE id_usuario = :id_usuario AND id_rol = :id_rol";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
            $sth->execute();
            $affected_rows = $sth->rowCount();
            $this->_DB->commit();
            return $affected_rows;
        } catch (Exception $ex) {
            $this->_DB->rollback();
            error_log("Error al quitar rol: " . $ex->getMessage());
            return null;
        }
    }
    
    function actualizarRoles($id_usuario, $roles_array){
        $this->connect();
        $this->_DB->beginTransaction();
        try {
            $sql = "DELETE FROM usuario_rol WHERE id_usuario = :id_usuario";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth->execute();
            
            if(is_array($roles_array) && count($roles_array) > 0){
                $sql = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)";
                $sth = $this->_DB->prepare($sql);
                foreach($roles_array as $id_rol){
                    $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
                    $sth->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
                    $sth->execute();
                }
            }
            
            $this->_DB->commit();
            return true;
        } catch (Exception $ex) {
            $this->_DB->rollback();
            error_log("Error al actualizar roles: " . $ex->getMessage());
            return false;
        }
    }
    
    function getUsuarioConRoles($id_usuario){
        $this->connect();
        $sql = "SELECT u.*, GROUP_CONCAT(r.rol SEPARATOR ', ') as roles,
                GROUP_CONCAT(r.id_rol) as ids_roles
                FROM usuario u
                LEFT JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                LEFT JOIN rol r ON ur.id_rol = r.id_rol
                WHERE u.id_usuario = :id_usuario
                GROUP BY u.id_usuario, u.correo, u.contrasena";
        $sth = $this->_DB->prepare($sql);
        $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}
?>