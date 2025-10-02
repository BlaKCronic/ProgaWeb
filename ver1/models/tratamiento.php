<?php
require_once "sistema.php";
class tratamiento extends Sistema{
    function create($data){
        $this->conect();
        $sql = "INSERT INTO tratamiento(tratamiento) VALUES (:tratamiento)";
        $sth = $this->_BD->prepare($sql);
        $sth->bindParam(":tratamiento", $data['tratamiento'], PDO::PARAM_STR);
        $sth->execute();
        $rows_affected = $sth->rowCount();
        return $rows_affected;
    }

    function read(){
        $this->conect();
        $sth = $this->_BD->prepare("SELECT * FROM tratamiento");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function readOne($id){
        $this->conect();
        $sth = $this->_BD->prepare("SELECT * FROM tratamiento WHERE id_tratamiento = :id_tratamiento");
        $sth->bindParam(":id_tratamiento", $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function update($data, $id){
        $this->conect();
        $sql = "UPDATE tratamiento SET tratamiento = :tratamiento WHERE id_tratamiento = :id_tratamiento";
        $sth = $this->_BD->prepare($sql);
        $sth->bindParam(":tratamiento", $data['tratamiento'], PDO::PARAM_STR);
        $sth->bindParam(":id_tratamiento", $id, PDO::PARAM_INT);
        $sth->execute();
        $rows_affected = $sth->rowCount();
        return $rows_affected;
    }

    function delete($id){
        if(is_numeric($id)){
            $this->conect();
            $sql = "DELETE FROM tratamiento WHERE id_tratamiento = :id_tratamiento";
            $sth = $this->_BD->prepare($sql);
            $sth->bindParam(":id_tratamiento", $id, PDO::PARAM_INT);
            $sth->execute();
            $rows_affected = $sth->rowCount();
            return $rows_affected;
        } else {
            return null;
        }
    }
}
?>