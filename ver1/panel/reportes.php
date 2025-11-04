<?php
require_once __DIR__ . '/../models/sistema.php';
require_once __DIR__ . '/../models/institucion.php';
require_once __DIR__ . '/../models/reportes.php';
$app = new Reportes();
$app->InstitucionesInvestigadores();
?>