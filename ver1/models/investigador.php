<?php
require_once "sistema.php";
class Investigador extends Sistema{
    function create($data){
        $this -> conect();
        $sth = $this -> _BD -> prepare("insert into investigador (primer_apellido, segundo_apellido, nombre, fotografia, id_institucion, semblanza, id_tratamiento) 
        values (:primer_apellido, :segundo_apellido, :nombre, :fotografia, :id_institucion, :semblanza, :id_tratamiento)");
        $sth -> bindParam(":primer_apellido", $data['primer_apellido']);
        $sth -> bindParam(":segundo_apellido", $data['segundo_apellido']);
        $sth -> bindParam(":nombre", $data['nombre']);
        $sth -> bindParam(":fotografia", $data['fotografia']);
        $sth -> bindParam(":id_institucion", $data['id_institucion']);
        $sth -> bindParam(":semblanza", $data['semblanza']);
        $sth -> bindParam(":id_tratamiento", $data['id_tratamiento']);
        $sth -> execute();
        $rows_affected = $sth -> rowCount();
        return $rows_affected;
    }

    function read(){
        $this->conect();
        $sql = "SELECT inv.*, i.institucion, t.tratamiento 
                FROM investigador inv 
                LEFT JOIN institucion i ON inv.id_institucion = i.id_institucion 
                LEFT JOIN tratamiento t ON inv.id_tratamiento = t.id_tratamiento";
        $sth = $this->_BD->prepare($sql);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function readOne($id){
        $this->conect();
        $sql = "SELECT inv.*, i.institucion, t.tratamiento 
                FROM investigador inv 
                LEFT JOIN institucion i ON inv.id_institucion = i.id_institucion 
                LEFT JOIN tratamiento t ON inv.id_tratamiento = t.id_tratamiento 
                WHERE inv.id_investigador = :id_investigador";
        $sth = $this->_BD->prepare($sql);
        $sth->bindParam(":id_investigador", $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function update($data, $id){
        $this->conect();
        $sql = "UPDATE investigador SET primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, nombre = :nombre, fotografia = :fotografia, id_institucion = :id_institucion, semblanza = :semblanza, id_tratamiento = :id_tratamiento WHERE id_investigador = :id_investigador";
        $sth = $this->_BD->prepare($sql);
        $sth->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $sth->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $sth->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $sth->bindParam(":fotografia", $data['fotografia'], PDO::PARAM_STR);
        $sth->bindParam(":id_institucion", $data['id_institucion'], PDO::PARAM_INT);
        $sth->bindParam(":semblanza", $data['semblanza'], PDO::PARAM_STR);
        $sth->bindParam(":id_tratamiento", $data['id_tratamiento'], PDO::PARAM_INT);
        $sth->bindParam(":id_investigador", $id, PDO::PARAM_INT);
        $sth->execute();
        $rows_affected = $sth->rowCount();
        return $rows_affected;
    }

    function delete($id){
        if(is_numeric($id)){
            $this->conect();
            $sql = "DELETE FROM investigador WHERE id_investigador = :id_investigador";
            $sth = $this->_BD->prepare($sql);
            $sth->bindParam(":id_investigador", $id, PDO::PARAM_INT);
            $sth->execute();
            $rows_affected = $sth->rowCount();
            return $rows_affected;
        } else {
            return null;
        }
    }
}
?>