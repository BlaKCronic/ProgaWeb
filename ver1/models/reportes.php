<?php

class Reportes extends Sistema {
    var $content;
    function __construct() {
        $this->content = ob_get_clean();
    }
    function InstitucionesInvestigadores(){
        require_once __DIR__ . '/../vendor/autoload.php';
        $institucion = new Institucion();
        $data = $institucion->reporteInvestigadoresPorInstitucion();
        $html2pdf = new Html2Pdf('P','A4','es');
        $html2pdf->writeHTML($this->content);
        $html2pdf->output('reporte_investigadores.pdf');
    }
}
?>