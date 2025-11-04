<?php
require_once "sistema.php";
class Investigador extends Sistema {
    
    function create($data) {
        $this->connect();
        $this->_DB->beginTransaction();
        try {
            $sql = "INSERT INTO investigador (primer_apellido, segundo_apellido, nombre, fotografia, id_institucion, semblanza, id_tratamiento) 
                    VALUES (:primer_apellido, :segundo_apellido, :nombre, :fotografia, :id_institucion, :semblanza, :id_tratamiento)";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
            $sth->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
            $sth->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
            $sth->bindParam(":semblanza", $data['semblanza'], PDO::PARAM_STR);
            $sth->bindParam(":id_institucion", $data['id_institucion'], PDO::PARAM_INT);
            $sth->bindParam(":id_tratamiento", $data['id_tratamiento'], PDO::PARAM_INT);
            
            $fotografia = $this->cargarFotografia('investigadores','fotografia');
            if(!$fotografia){
                $fotografia = 'default.jpg';
            }
            $sth->bindParam(":fotografia", $fotografia, PDO::PARAM_STR);
            $sth->execute();
            $affected_rows = $sth->rowCount();
            
            $id_investigador = $this->_DB->lastInsertId();
            
            $sql = "INSERT INTO usuario (correo, contrasena) 
                    VALUES (:correo, :contrasena)";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $pwd = md5($data['password']);
            $sth->bindParam(":contrasena", $pwd, PDO::PARAM_STR);
            $sth->execute();
            
            $id_usuario = $this->_DB->lastInsertId();
            
            $sql = "INSERT INTO usuario_rol (id_usuario, id_rol)
                    VALUES (:id_usuario, 2)";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth->execute();
            
            $sql = "UPDATE investigador SET id_usuario = :id_usuario 
                    WHERE id_investigador = :id_investigador";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth->bindParam(":id_investigador", $id_investigador, PDO::PARAM_INT);
            $sth->execute();
            
            $this->_DB->commit();
            return $affected_rows;
        } catch (Exception $ex) {
            $this->_DB->rollback();
            error_log("Error al crear investigador: " . $ex->getMessage());
            return null;
        }
    }

    function read(){
        $this->connect();
        $sql = "SELECT inv.*, i.institucion, t.tratamiento
                FROM investigador inv 
                LEFT JOIN institucion i ON inv.id_institucion = i.id_institucion
                LEFT JOIN tratamiento t ON inv.id_tratamiento = t.id_tratamiento";
        $sth = $this->_DB->prepare($sql);
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    function readOne($id){
        $this->connect();
        $sql = "SELECT inv.*, i.institucion, t.tratamiento
                FROM investigador inv 
                LEFT JOIN institucion i ON inv.id_institucion = i.id_institucion
                LEFT JOIN tratamiento t ON inv.id_tratamiento = t.id_tratamiento 
                WHERE id_investigador = :id_investigador";
        $sth = $this->_DB->prepare($sql);
        $sth->bindParam(":id_investigador", $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function update($data, $id){
        if (!is_numeric($id)) {
            return null;    
        }  
        if ($this->validate($data)) {
            $this->connect(); 
            $this->_DB->beginTransaction();
            try {
                $sql = "UPDATE investigador SET primer_apellido = :primer_apellido, 
                segundo_apellido = :segundo_apellido, nombre = :nombre,  
                id_institucion = :id_institucion, semblanza = :semblanza, id_tratamiento = :id_tratamiento 
                WHERE id_investigador = :id_investigador";
                
                if (isset($_FILES['fotografia'])) {
                    if ($_FILES['fotografia']['error'] === 0) {
                        $sql = "UPDATE investigador SET primer_apellido = :primer_apellido, 
                            segundo_apellido = :segundo_apellido, nombre = :nombre, fotografia = :fotografia,
                            id_institucion = :id_institucion, semblanza = :semblanza, id_tratamiento = :id_tratamiento 
                            WHERE id_investigador = :id_investigador";
                        $fotografia = $this->cargarFotografia('investigadores','fotografia');
                    }
                }
                
                $sth = $this->_DB->prepare($sql);
                $sth->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
                $sth->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
                $sth->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
                $sth->bindParam(":id_institucion", $data['id_institucion'], PDO::PARAM_INT);
                $sth->bindParam(":semblanza", $data['semblanza'], PDO::PARAM_STR);
                $sth->bindParam(":id_tratamiento", $data['id_tratamiento'], PDO::PARAM_INT);
                $sth->bindParam(":id_investigador", $id, PDO::PARAM_INT);
                
                if (isset($_FILES['fotografia'])) {
                    if ($_FILES['fotografia']['error'] === 0) {
                        $sth->bindParam(":fotografia", $fotografia, PDO::PARAM_STR);
                    }
                }
                
                $sth->execute(); 
                $affected_rows = $sth->rowCount();  
                $this->_DB->commit();
                return $affected_rows;
            } catch (Exception $ex) {
                $this->_DB->rollback();
                error_log("Error al actualizar investigador: " . $ex->getMessage());
            }
            return null;
        } 
        return null;
    }

    function delete($id){
        if (is_numeric($id)) {
            $this->connect();
            $this->_DB->beginTransaction();
            try {
                $sql = "SELECT id_usuario FROM investigador WHERE id_investigador = :id_investigador";
                $sth = $this->_DB->prepare($sql);
                $sth->bindParam(":id_investigador", $id, PDO::PARAM_INT);
                $sth->execute();
                $inv = $sth->fetch(PDO::FETCH_ASSOC);
                
                $sql = "DELETE FROM investigador WHERE id_investigador = :id_investigador";
                $sth = $this->_DB->prepare($sql);
                $sth->bindParam(":id_investigador", $id, PDO::PARAM_INT);
                $sth->execute();
                $affected_rows = $sth->rowCount();
                
                if($inv && isset($inv['id_usuario']) && $inv['id_usuario'] != null){
                    $sql = "DELETE FROM usuario_rol WHERE id_usuario = :id_usuario";
                    $sth = $this->_DB->prepare($sql);
                    $sth->bindParam(":id_usuario", $inv['id_usuario'], PDO::PARAM_INT);
                    $sth->execute();
                    
                    $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
                    $sth = $this->_DB->prepare($sql);
                    $sth->bindParam(":id_usuario", $inv['id_usuario'], PDO::PARAM_INT);
                    $sth->execute();
                }
                
                $this->_DB->commit();
                return $affected_rows;
            } catch (Exception $ex) {
                $this->_DB->rollback();
                error_log("Error al eliminar investigador: " . $ex->getMessage());
            }
            return null;
        } else {
            return null;
        }
    }

    function validate($data){
        return true;
    }

    function reporteInvestigadoresPorInstitucion($id_institucion){
        $this->connect();
        $sql = "SELECT inv.*, i.institucion, t.tratamiento
                FROM investigador inv 
                LEFT JOIN institucion i ON inv.id_institucion = i.id_institucion
                LEFT JOIN tratamiento t ON inv.id_tratamiento = t.id_tratamiento 
                WHERE inv.id_institucion = :id_institucion";
        $sth = $this->_DB->prepare($sql);
        $sth->bindParam(":id_institucion", $id_institucion, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }
}
?>