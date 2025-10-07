<?php
class Sistema{
    var $_DNS = "mysql:host=mariadb;dbname=database";
    var $_USER = "user";
    var $_PASSWORD = "password";
    var $_BD = null;
    function conect(){
        $this -> _BD = new PDO($this -> _DNS, $this -> _USER, $this -> _PASSWORD);
    }

    function cargarFotografia($carpeta){
        if(move_uploaded_file($_FILES['fotografia']['tmp_name'], '../img/' . $carpeta . '/' . $_FILES['fotografia']['name'])){
            return $_FILES['fotografia']['name'];
        } else {
            return null;
        }
    }
}
?>