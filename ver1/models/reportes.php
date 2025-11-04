<?php

class Reportes extends Sistema {
    var $content;
    
    function __construct() {
        parent::__construct();
        ob_start();
    }
    
    function InstitucionesInvestigadores(){
        require_once __DIR__ . '/../vendor/autoload.php';
        require_once __DIR__ . '/institucion.php';
        require_once __DIR__ . '/investigador.php';
        
        $institucion = new Institucion();
        $investigador = new Investigador();
        
        $data = $institucion->reporteInstitucion();
        
        if(!$data || count($data) == 0){
            $this->content = "<h1>No hay datos disponibles</h1>";
        } else {
            $this->content = "
            <style>
                body { font-family: Arial, sans-serif; }
                h1 { color: #333; text-align: center; margin-bottom: 30px; }
                table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                th { background-color: #007bff; color: white; padding: 12px; text-align: left; }
                td { padding: 10px; border-bottom: 1px solid #ddd; }
                tr:hover { background-color: #f5f5f5; }
                .total { font-weight: bold; background-color: #e9ecef; }
            </style>
            <h1>Reporte de Investigadores por Institución</h1>
            <table border='1'>
                <thead>
                    <tr>
                        <th>Institución</th>
                        <th style='text-align: center;'>Cantidad de Investigadores</th>
                    </tr>
                </thead>
                <tbody>";
            
            $total = 0;
            foreach($data as $row){
                $this->content .= "
                    <tr>
                        <td>{$row['institucion']}</td>
                        <td style='text-align: center;'>{$row['cantidad_investigador']}</td>
                    </tr>";
                $total += $row['cantidad_investigador'];
            }
            
            $this->content .= "
                    <tr class='total'>
                        <td>TOTAL</td>
                        <td style='text-align: center;'>{$total}</td>
                    </tr>
                </tbody>
            </table>
            <p style='text-align: center; color: #666; margin-top: 30px;'>
                Generado el: " . date('d/m/Y H:i:s') . "
            </p>";
        }
        
        try {
            $html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'es');
            $html2pdf->writeHTML($this->content);
            $html2pdf->output('reporte_instituciones_investigadores.pdf');
        } catch(\Spipu\Html2Pdf\Exception\Html2PdfException $e) {
            echo "Error al generar el PDF: " . $e->getMessage();
        }
    }
    
    function ReporteInvestigadoresPorInstitucion($id_institucion){
        require_once __DIR__ . '/../vendor/autoload.php';
        require_once __DIR__ . '/institucion.php';
        require_once __DIR__ . '/investigador.php';
        
        $institucion = new Institucion();
        $investigador = new Investigador();
        
        $dataInstitucion = $institucion->readOne($id_institucion);
        
        if(!$dataInstitucion){
            $this->content = "<h1>Institución no encontrada</h1>";
        } else {
            $investigadores = $investigador->reporteInvestigadoresPorInstitucion($id_institucion);
            
            $this->content = "
            <style>
                body { font-family: Arial, sans-serif; }
                h1 { color: #333; text-align: center; margin-bottom: 10px; }
                h2 { color: #666; text-align: center; margin-bottom: 30px; }
                table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                th { background-color: #007bff; color: white; padding: 12px; text-align: left; }
                td { padding: 10px; border-bottom: 1px solid #ddd; }
                tr:hover { background-color: #f5f5f5; }
                .total { font-weight: bold; background-color: #e9ecef; }
            </style>
            <h1>Reporte de Investigadores</h1>
            <h2>{$dataInstitucion['institucion']}</h2>
            <table border='1'>
                <thead>
                    <tr>
                        <th>Tratamiento</th>
                        <th>Nombre Completo</th>
                        <th>Institución</th>
                    </tr>
                </thead>
                <tbody>";
            
            if($investigadores && count($investigadores) > 0){
                foreach($investigadores as $inv){
                    $nombreCompleto = $inv['tratamiento'] . ' ' . $inv['nombre'] . ' ' . 
                                     $inv['primer_apellido'] . ' ' . $inv['segundo_apellido'];
                    $this->content .= "
                        <tr>
                            <td>{$inv['tratamiento']}</td>
                            <td>{$nombreCompleto}</td>
                            <td>{$inv['institucion']}</td>
                        </tr>";
                }
                
                $this->content .= "
                        <tr class='total'>
                            <td colspan='2'>TOTAL DE INVESTIGADORES</td>
                            <td style='text-align: center;'>" . count($investigadores) . "</td>
                        </tr>";
            } else {
                $this->content .= "
                        <tr>
                            <td colspan='3' style='text-align: center;'>
                                No hay investigadores registrados en esta institución
                            </td>
                        </tr>";
            }
            
            $this->content .= "
                </tbody>
            </table>
            <p style='text-align: center; color: #666; margin-top: 30px;'>
                Generado el: " . date('d/m/Y H:i:s') . "
            </p>";
        }
        
        try {
            $html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'es');
            $html2pdf->writeHTML($this->content);
            $html2pdf->output('reporte_investigadores_' . $id_institucion . '.pdf');
        } catch(\Spipu\Html2Pdf\Exception\Html2PdfException $e) {
            echo "Error al generar el PDF: " . $e->getMessage();
        }
    }
}
?>