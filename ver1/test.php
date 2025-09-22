<?php
require_once "models/institucion.php";
$app = new Institucion;
//$filas_afectadas = $app -> delete(1);
$data ['institucion'] = "Instituto Tecnologico de Tijuana";
$data ['logotipo'] = "logotipo_prueba.png";
$filas_afectadas = $app -> create($data);
//print_r($filas_afectadas);
?>