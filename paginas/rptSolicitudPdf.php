<?php
require('../fpdf/fpdf.php');
include '../clases/clsSolicitud.php';
include_once '../clases/funciones.php';

$numeroOrden = $_GET["no"];
$oSolicitud = new clsSolicitud();

date_default_timezone_set('UTC');
$arrSol = $oSolicitud->devuelveSolicitudPresupuestoArray($numeroOrden);

class PDF extends FPDF{
    function tablaPresupuesto($encabezado,$datos){
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(235,235,235);
        $this->SetTextColor(0);
        // $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.2);
        $this->SetFont('','B');
        // Cabecera
        $w = array(25, 95, 15, 30, 30);
        for($i=0;$i<count($encabezado);$i++)
            $this->Cell($w[$i],7,$encabezado[$i],1,0,'C',true);

        $this->Ln();
        // Restauración de colores y fuentes
        $this->SetFillColor(240,240,240);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Datos
        $fill = false;

        $totFilasPpto = count($datos);
        $filasQueFaltan = 8 - $totFilasPpto;

        if($totFilasPpto!=0){
            foreach($datos as $row)
            {
                $this->Cell($w[0],6,$row["numeroDeParte"],'LR',0,'C',$fill);
                $this->Cell($w[1],6,$row["concepto"],'LR',0,'L',$fill);
                $this->Cell($w[2],6,$row["unidades"],'LR',0,'C',$fill);
                $this->Cell($w[3],6,number_format($row["precio"],2),'LR',0,'R',$fill);
                $this->Cell($w[4],6,number_format($row["subtotal"],2),'LR',0,'R',$fill);
                $this->Ln();
                $fill = !$fill;
            }
        }
        // Para rellenar filas vacías y completar el formato
        for($i=0;$i<$filasQueFaltan;$i++){
            $this->Cell($w[0],6,'','LR',0,'C',$fill);
            $this->Cell($w[1],6,'','LR',0,'L',$fill);
            $this->Cell($w[2],6,'','LR',0,'C',$fill);
            $this->Cell($w[3],6,'','LR',0,'R',$fill);
            $this->Cell($w[4],6,'','LR',0,'R',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Línea de cierre
        $this->Cell(array_sum($w),0,'','T',2);
    }
}


$pdf = new PDF();
// $pdf->SetMargins(2,3,2);
$pdf->SetFillColor(232,232,232);
$pdf->SetLinewidth(.2);
$pdf->AddPage('Portrait','Letter');
$pdf->SetFont('Times','B',12);

$pdf->Image('../imagenes/logotipo.jpg',15,8,35);
$m1=53; // es el margen en el encabezado
$pdf->SetX($m1);
$pdf->Cell(150,5,utf8_decode('FORMATO DE SOLICITUD DE SERVICIO'),'T',1,'C');
$pdf->SetX($m1);
$pdf->Cell(150,5,utf8_decode('TECNOHOME'),0,1,'C');
$pdf->SetX($m1);
$pdf->Cell(150,5,utf8_decode('Rodríguez Clara No. 203-A Col. Felipe Carrillo Puerto. Xalapa, Ver.'),'0',1,'C');
$pdf->SetX($m1);
$pdf->Cell(150,5,utf8_decode('Cel. 2284063365, 2281580850'),'B',1,'C');
$pdf->SetLinewidth(.2); 

$pdf->Ln(2);

$pdf->SetY(30); $pdf->SetX(152);
$pdf->SetFont('Times','',11);
$pdf->Cell(27,10,'Orden:',0,0,'R');

$pdf->SetY(31); $pdf->SetX(180);
$pdf->SetFont('Helvetica','B',16);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(42,8,strzero($arrSol->datSolicitud["numeroDeOrden"],4),0,1);
$pdf->SetTextColor(0,0,0); // volvemos al color de fuente negro

$pdf->SetY(35);
$pdf->SetX(152);
$pdf->SetFont('Times','',11);
$pdf->Cell(27,10,'Fecha de orden:',0,0,'R');
$pdf->SetFont('Times','B',11);
$pdf->SetX(180);
$pdf->Cell(20,10,utf8_decode(date("d/m/Y",strtotime($arrSol->datSolicitud["fechaOrden"]))),0,1);

$pdf->SetY(40);
$pdf->SetX(152);
$pdf->SetFont('Times','',11);
$pdf->Cell(27,10,'Fecha de visita:',0,0,'R');
$pdf->SetFont('Times','B',11);
$pdf->SetX(180);
$pdf->Cell(20,10,utf8_decode(date("d/m/Y",strtotime($arrSol->datSolicitud["fechaVisita"]))),0,1);


$pdf->SetX(10);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(38,5,'DATOS DEL CLIENTE:',0,0);

$pdf->Ln(6);
$pdf->SetX(10);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(18,5,utf8_decode('Nombre:'),0,0,'L');
$pdf->SetFont('Helvetica','',8);
$pdf->SetX(28);
$pdf->Cell(85,5,utf8_decode($arrSol->datSolicitud["nombreDelCliente"]),'B',1);

$pdf->SetX(10);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(18,5,utf8_decode('Dirección:'),0,0,'L');
$pdf->SetFont('Helvetica','',8);
$pdf->SetX(28);
$pdf->Cell(85,5,utf8_decode($arrSol->datSolicitud["direccionDelCliente"]),'B',1);

$pdf->SetX(10);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(18,5,utf8_decode('Teléfono:'),0,0,'L');
$pdf->SetFont('Helvetica','',8);
$pdf->SetX(28);
$pdf->Cell(85,5,utf8_decode($arrSol->datSolicitud["telefonoDelCliente"]),'B',1);

$pdf->SetX(10);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(18,5,utf8_decode('Celular:'),0,0,'L');
$pdf->SetFont('Helvetica','',8);
$pdf->SetX(28);
$pdf->Cell(85,5,utf8_decode($arrSol->datSolicitud["celularDelCliente"]),'B',1);

$pdf->SetX(10);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(18,5,utf8_decode('Correo e.:'),0,0,'L');
$pdf->SetFont('Helvetica','',8);
$pdf->SetX(28);
$pdf->Cell(85,5,utf8_decode($arrSol->datSolicitud["correoElectronicoDelCliente"]),'B',1);

$pdf->SetY(50);
$pdf->SetX(115);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(38,5,'DATOS DEL PRODUCTO:',0,0,'L');
$pdf->Ln(6);
$pdf->SetX(115);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(22,5,utf8_decode('Descripción:'),0,0,'L');
$pdf->SetFont('Helvetica','',8);
$pdf->SetX(137);
$pdf->Cell(65,5,utf8_decode($arrSol->datSolicitud["descripcionDelProducto"]),'B',1);

$pdf->SetX(115);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(22,5,utf8_decode('Marca:'),0,0,'L');
$pdf->SetFont('Helvetica','',8);
$pdf->SetX(137);
$pdf->Cell(65,5,utf8_decode($arrSol->datSolicitud["marcaDelProducto"]),'B',1);

$pdf->SetX(115);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(22,5,utf8_decode('Modelo:'),0,0,'L');
$pdf->SetFont('Helvetica','',8);
$pdf->SetX(137);
$pdf->Cell(65,5,utf8_decode($arrSol->datSolicitud["modeloDelProducto"]),'B',1);

$pdf->SetX(115);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(22,5,utf8_decode('Serie:'),0,0,'L');
$pdf->SetFont('Helvetica','',8);
$pdf->SetX(137);
$pdf->Cell(65,5,utf8_decode($arrSol->datSolicitud["serieDelProducto"]),'B',1);

$pdf->SetY(90);
$pdf->SetFont('Helvetica','B','10');
$pdf->Cell(95,5,utf8_decode('FALLA'),0,1);
$pdf->SetFont('Helvetica','',8);
$pdf->MultiCell(190,3,utf8_decode($arrSol->datSolicitud["fallaProducto"]),0,'L');

$pdf->Ln(3);
$pdf->SetFont('Helvetica','B','10');
$pdf->Cell(95,5,utf8_decode('DIAGNÓSTICO TÉCNICO'),0,1);
$pdf->SetFont('Helvetica','',8);
$pdf->MultiCell(190,3,utf8_decode($arrSol->datSolicitud["diagnostico"]),0,'L');

$pdf->Ln(3);
$pdf->SetFont('Helvetica','B','10');
$pdf->Cell(95,5,utf8_decode('TRABAJO A REALIZAR'),0,1);
$pdf->SetFont('Helvetica','',8);
$pdf->MultiCell(190,3,utf8_decode($arrSol->datSolicitud["trabajoRealizado"]),0,'L');

$pdf->Ln(3);
$pdf->SetFont('Helvetica','B','10');
$pdf->Cell(95,5,utf8_decode('PRESUPUESTO'),0,1);
$pdf->SetFont('Helvetica','',8);
$titulosTabla = array('#Parte','Concepto','Unidades','Precio','Importe');
$pdf->tablaPresupuesto($titulosTabla,$arrSol->datPresupuesto);
$y=$pdf->GetY();


$pdf->SetFont('Helvetica','B','7');
$pdf->Cell(95,4,utf8_decode('Nota'),0,1);
$pdf->SetFont('Helvetica','',7);
$nota1="Después de 60 días sin seguimiento por parte del cliente, la empresa no se hace responsable.";
$nota2="La garantía de una reparación es de 60 días en mano de obra sobre la misma falla.";
$pdf->MultiCell(190,3,utf8_decode($nota1),0,'L');
$pdf->MultiCell(190,3,utf8_decode($nota2),0,'L');

$sub = ($arrSol->datTotales["Subtotal"]==0 ? "" : "$".number_format($arrSol->datTotales["Subtotal"],2));
$iva = ($arrSol->datTotales["Iva"]==0 ? "" : "$".number_format($arrSol->datTotales["Iva"],2));
$tot = ($arrSol->datTotales["Total"]==0 ? "" : "$".number_format($arrSol->datTotales["Total"],2));

$pdf->SetY($y);
$pdf->SetX(145);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(30,5,'SUBTOTAL:',0,0,'R');
$pdf->Cell(30,5,$sub,'B',2,'R');

$pdf->SetX(145);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(30,5,'IVA:',0,0,'R');
$pdf->Cell(30,5,$iva,'B',2,'R');

$pdf->SetX(145);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(30,5,'TOTAL:',0,0,'R');
$pdf->Cell(30,5,$tot,'B',2,'R');

$pdf->SetY($pdf->GetY()+20);

$pdf->SetX(30);
$pdf->Cell(70,5,utf8_decode('TÉCNICO'),'T',0,'C');
$pdf->SetX(120);
$pdf->Cell(70,5,utf8_decode('CLIENTE'),'T',0,'C');

$arch = 'Solicitud'.$arrSol->datSolicitud["numeroDeOrden"].'.pdf';
$pdf->Output($arch,'I');
?>