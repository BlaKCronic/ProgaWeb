<?php
session_start();
require_once "models/sistema.php";
$sistema = new Sistema();
$login = $sistema -> login("22030935@itcelaya.edu.mx","123");
if($login){
    echo "Login exitoso";
}else{
    echo "Login fallido";
}
?>