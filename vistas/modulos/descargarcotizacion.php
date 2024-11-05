<?php

require "../../lib/fpdf/fpdf.php";
require "../../lib/numerosaletras/numeroaletras.php";

require_once "../../modelos/servicio.modelo.php";

$modelonumero = new modelonumero();

$idServicio = $_GET["idServicioCotizacion"];

$detalleServicio = ModeloServicio::mdlListarServiciosPendientes($idServicio);

$placaVehiculo = null;
$marcaModelo = null;
$fechaIngreso = null;
$kilometraje = null;
$descServicio = null;

foreach($detalleServicio as $key => $servicio){

    $placaVehiculo = $servicio["PLACA_VEHICULO"];
    $marcaModelo = $servicio["MARCA_MODELO"];
    $fechaIngreso = $servicio["FECHA_INGRESO"];
    $kilometraje = $servicio["KM_INGRESO"];
    $descServicio = $servicio["DETALLE_SERVICIO"];

}

//var_dump($detalleServicio);

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../../vistas/dist/img/logo.png',10,7,25);
        // Arial bold 15
        $this->SetFont('Arial','B',18);
        // Movernos a la derecha
        $this->Cell(81);
        // Título
        $this->Cell(30,10,'Ccoricars',0,0,'C');
        // Salto de línea
        $this->Ln(7);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

/**********  Inicio Contenido PDF  ************/
$pdf->SetFont('Arial','',12);
$pdf->Cell(64);// Movernos 64 a la derecha
$pdf->Cell(40,10,utf8_decode('Direccion....'));
$pdf->Ln(7);
$pdf->Cell(75);// Movernos 75 a la derecha
$pdf->Cell(40,10,utf8_decode('RUC: XXXXXXXXX'));

$pdf->Ln(16);   //Salto de Linea de 16

$pdf->SetFont('Arial','',17);
$pdf->Cell(0,10,'Orden de servicio',0,0,'C');     // 'C' de centrado

$pdf->Ln(12);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Placa: ', 0, 0, '');
$pdf->Cell(60, 10, $placaVehiculo);
//$pdf->Ln(7);
$pdf->Cell(40, 10, 'Marca / modelo: ', 0, 0, '');
$pdf->Cell(0, 10, $marcaModelo);
$pdf->Ln(7);
$pdf->Cell(30, 10, 'Ingreso: ', 0, 0, '');
$pdf->Cell(60, 10, $fechaIngreso);
//$pdf->Ln(7);
$pdf->Cell(40, 10, 'Kilometraje: ', 0, 0, '');
$pdf->Cell(0, 10, $kilometraje);
$pdf->Ln(7);
$pdf->Cell(30, 10, 'Servicio: ', 0, 0, '');
$pdf->MultiCell( 139, 5, $descServicio, 0);

$pdf->Ln(15);

$pdf->Cell(0, 10, 'Servicios:');

$pdf->Ln(10);


////
$pdf->SetFont('Arial', 'B', 10);

//Colores:
/*
$pdf->SetDrawColor(0,80,180);
$pdf->SetFillColor(220,50,50);
$pdf->SetTextColor(220,50,50);
*/

$pdf->Cell(15, 8, 'Item', 1, 0, 'C');
$pdf->Cell(144, 8, 'Descripcion', 1, 0, 'C');
$pdf->Cell(30, 8, 'Sub Total', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

//var_dump($itemsServicio);

$itemsServicio = ModeloServicio::mdlMostrarDetelleServicio($idServicio);

$n = 0;

$totalSubtotal = 0;

foreach($itemsServicio as $key => $item){

    $n++;

    $subtotal = $item["SUBTOTAL"];

    $totalSubtotal = $totalSubtotal + $subtotal;

    $pdf->Cell(15, 8, $n, 1, 0, '');
    $pdf->Cell(144, 8, $item["ITEM"], 1, 0, '');
    $pdf->Cell(30, 8, number_format($item["SUBTOTAL"],2), 1, 1, 'R');

}

$pdf->Ln(6);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(140, 6, 'Total:', 0, 0, 'R');
$pdf->Cell(49, 6, 'S/. '.number_format($totalSubtotal,2), 0, 1, 'R');

$pdf->Ln(15);

$letras = $modelonumero->numtoletras(abs($totalSubtotal));

$pdf->Cell(0, 10, 'SON: '.$letras, 0, 0, '');
/**********  Fin Contenido PDF  ************/

$pdf->Output();

