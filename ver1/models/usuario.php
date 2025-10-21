<?php
require_once "sistema.php";

class Usuario extends Sistema {

    function create($data) {
        $this->conect();
        $sql = "INSERT INTO usuario (correo, contrasena, token, fecha_token_date) 
                VALUES (:correo, :contrasena, :token, :fecha_token_date)";
        $sth = $this->_BD->prepare($sql);
        $sth->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $sth->bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);
        $sth->bindParam(":token", $data['token'], PDO::PARAM_STR);
        $sth->bindParam(":fecha_token_date", $data['fecha_token_date'], PDO::PARAM_STR);
        $sth->execute();
        $rows_affected = $sth->rowCount();
        return $rows_affected;
    }

    function read() {
        $this->conect();
        $sth = $this->_BD->prepare("SELECT * FROM usuario");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function readOne($id) {
        $this->conect();
        $sth = $this->_BD->prepare("SELECT * FROM usuario WHERE id_usuario = :id_usuario");
        $sth->bindParam(":id_usuario", $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function update($data, $id) {
        $this->conect();
        $sql = "UPDATE usuario 
                SET correo = :correo, contrasena = :contrasena, token = :token, fecha_token_date = :fecha_token_date
                WHERE id_usuario = :id_usuario";
        $sth = $this->_BD->prepare($sql);
        $sth->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $sth->bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);
        $sth->bindParam(":token", $data['token'], PDO::PARAM_STR);
        $sth->bindParam(":fecha_token_date", $data['fecha_token_date'], PDO::PARAM_STR);
        $sth->bindParam(":id_usuario", $id, PDO::PARAM_INT);
        $sth->execute();
        $rows_affected = $sth->rowCount();
        return $rows_affected;
    }

    function delete($id) {
        if (is_numeric($id)) {
            $this->conect();
            $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
            $sth = $this->_BD->prepare($sql);
            $sth->bindParam(":id_usuario", $id, PDO::PARAM_INT);
            $sth->execute();
            $rows_affected = $sth->rowCount();
            return $rows_affected;
        } else {
            return null;
        }
    }
}
?>
