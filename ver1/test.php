<?php
require_once "models/institucion.php";
$app = new Institucion;
$filas_afectadas = $app -> delete(1);
print_r($filas_afectadas);
?>