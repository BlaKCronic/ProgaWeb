<?php
require_once "sistema.php";
class Institucion extends Sistema{
    function create($data){
        $this->connect();
        $sql = "INSERT INTO institucion(institucion, logotipo) VALUES (:institucion, :logotipo);";
        $sth = $this->_db->prepare($sql);
        $sth->bindParam(":institucion", $data['institucion'], PDO::PARAM_STR);
        $sth->bindParam(":logotipo", $data['logotipo'], PDO::PARAM_STR);
        $sth->execute();
        $rows_affected = $sth->rowCount();
        return $rows_affected;
    }

    function read(){
        $this->connect();
        $sth = $this->_db->prepare("SELECT * FROM institucion");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function readOne($id){
        $this->connect();
        $sth = $this->_db->prepare("SELECT * FROM institucion WHERE id_institucion = :id_institucion");
        $sth->bindParam(":id_institucion", $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function update($data, $id){
        $this->connect();
        $sql = "UPDATE institucion SET institucion = :institucion, logotipo = :logotipo WHERE id_institucion = :id_institucion";
        $sth = $this->_db->prepare($sql);
        $sth->bindParam(":institucion", $data['institucion'], PDO::PARAM_STR);
        $sth->bindParam(":logotipo", $data['logotipo'], PDO::PARAM_STR);
        $sth->bindParam(":id_institucion", $id, PDO::PARAM_INT);
        $sth->execute();
        $rows_affected = $sth->rowCount();
        return $rows_affected;
    }

    function delete($id){
        if(is_numeric($id)){
            $this->connect();
            $sql = "DELETE FROM institucion WHERE id_institucion = :id_institucion";
            $sth = $this->_db->prepare($sql);
            $sth->bindParam(":id_institucion", $id, PDO::PARAM_INT);
            $sth->execute();
            $rows_affected = $sth->rowCount();
            return $rows_affected;
        } else {
            return null;
        }
    }
}
?>