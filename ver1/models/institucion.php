<?php
require_once "sistema.php";
class Institucion extends Sistema{
    function create($date){
        $this -> conect();
        $sql = ("insert into institucion(institucion, logotipo) values (:institucion, :logotipo);");
        $sth = $this -> _BD -> prepare($sql);
        $sth -> bindParam(":institucion", $data['institucion'], PDO::PARAM_STR);
        $sth -> bindParam(":logotipo", $data['logotipo'], PDO::PARAM_STR);
        $sth -> execute();
        $rows_affected = $sth -> rowCount();
        return $rows_affected;
    }

    function read(){
        $this -> conect();
        $sth = $this -> _BD -> prepare("SELECT * FROM institucion");
        $sth -> execute();
        $data = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function readOne(){
        return $data;
    }

    function update($data, $id){
        return $rows_affected;
    }

    function delete($id){
        if(!is_numeric($id)){
            $this -> conect();
            $sth = "DELETE FROM institucion WHERE id_institucion = :id_institucion";
            $sth = $this -> _BD -> prepare($sql);
            $sth -> bindParam(":id_institucion", $id, PDO::PARAM_INT);
            $sth -> execute();
            $rows_affected = $sth -> rowCount();
            return $rows_affected;
        } else {
            return null;
        }
    }
}
?>