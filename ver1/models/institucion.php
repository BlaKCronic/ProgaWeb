<?php
class Sistema{
    var $_DNS = "mysql:host=mariadb;dbname=database";
    var $_USER = "user";
    var $_PASSWORD = "password";
    var $_BD = null;
    function conect(){
        $this -> _BD = new PDO($this -> _DNS, $this -> _USER, $this -> _PASSWORD);
    }
}

class Institucion extends Sistema{
    function create($date){
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
        return $rows_affected;
    }
}
?>