<?php
require_once "sistema.php";
class Investigador extends Sistema{
    function create($date){
        return $rows_affected;
    }

    function read(){
        $this -> conect();
        $sth = $this -> _BD -> prepare("select i.institucion, inv.*
        from institucion i join investigador inv
        on i.id_institucion = inv.id_institucion;");
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
        return $rows_affected;
    }
}
?>