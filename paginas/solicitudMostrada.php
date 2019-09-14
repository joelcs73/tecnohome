<?php
include_once('./clases/clsSolicitud.php');
$oSol = new clsSolicitud();

$numeroDeOrden = $_GET["n"];

$objSol = $oSol->devuelveSolicitudPresupuestoArray($numeroDeOrden);

$montos ='';
$falla = '';
$diagnostico = '';
$trabajo='';
$diasTranscurridos='';
$direccion='';
if($objSol->datSolicitud["direccionDelCliente"]!=""){
  $direccion = '<strong>Dirección:</strong>'.$objSol->datSolicitud["direccionDelCliente"].'</br>';
}
if($objSol->datTotales["Total"]>0){
    $montos = '<strong>Subtotal:</strong>'.$objSol->datTotales["Subtotal"].'<strong> Iva:</strong>'.$objSol->datTotales["Iva"].'<strong> Total:</strong>'.$objSol->datTotales["Total"];
}
if($objSol->datSolicitud["fallaProducto"]!=''){
    $falla = '<strong>Falla:</strong>'.$objSol->datSolicitud["fallaProducto"].'</br>';
}
if($objSol->datSolicitud["diagnostico"]!=''){
    $diagnostico = '<strong>Diagnóstico:</strong>'.$objSol->datSolicitud["diagnostico"].'</br>';
}
if($objSol->datSolicitud["trabajoRealizado"]!=''){
    $trabajo = '<strong>Trabajo a realizar:</strong>'.$objSol->datSolicitud["trabajoRealizado"].'</br>';
}
if($objSol->datSolicitud["estado"]=='Pendiente' && $objSol->datSolicitud["dias"]>0){
    $diasTranscurridos = '<strong>'.$objSol->datSolicitud["dias"].'</strong> '.($objSol->datSolicitud["dias"]==1 ? 'día' : 'días');
}
$color="text-primary";
echo '
<div class="row" align="center">
<div class="col col-sm-12">
    <div class="card bg-light border-default mb-1" align="left" style="max-width: 40rem;">
        <div class="card-header">
          <h4 align="center">Solicitud de servicio</h4>
            <div class="row">
                <div class="col col-sm-6">
                  <p class="mb-2">
                  <strong class="'.$color.'">Orden</strong><br>
                    <strong>Número:</strong>'.$objSol->datSolicitud["numeroDeOrden"].'<br>
                    <strong>F. de orden:</strong>'.$objSol->datSolicitud["fechaOrden"].'<br>
                    <strong>F. de visita:</strong>'.$objSol->datSolicitud["fechaVisita"].'<br>
                  </p>
                  <p class="mb-2">
                    <strong class="'.$color.'">Cliente</strong><br>
                    <strong>Nombre:</strong>'.$objSol->datSolicitud["nombreDelCliente"].'<br>
                    <strong>Dirección:</strong>'.$objSol->datSolicitud["direccionDelCliente"].'<br>
                    <strong>Teléfono:</strong>'.$objSol->datSolicitud["telefonoDelCliente"].'<br>
                    <strong>Correo:</strong>'.$objSol->datSolicitud["correoElectronicoDelCliente"].'<br>
                  </p>
                </div>
                <div class="col col-sm-6">
                  <p class="mb-2">
                    <strong class="'.$color.'">Producto</strong><br>
                    <strong>Descripción:</strong>'.$objSol->datSolicitud["descripcionDelProducto"].'<br>
                    <strong>Marca:</strong>'.$objSol->datSolicitud["marcaDelProducto"].'<br>
                    <strong>Modelo:</strong>'.$objSol->datSolicitud["modeloDelProducto"].'<br>
                    <strong>Serie:</strong>'.$objSol->datSolicitud["serieDelProducto"].'<br>
                  </p>
                  <p class="mb-2">
                    <strong class="'.$color.'">Falla</strong><br>
                    '.$objSol->datSolicitud["fallaProducto"].'<br>
                  </p>
                </div>
            </div>
            <div class="row">
              <div class="col col-auto">
              <p class="mb-2">
                <strong class="'.$color.'">Diagnóstico técnico</strong><br>
                '.$objSol->datSolicitud["diagnostico"].'<br>
              </p>
              <p class="mb-2">
                <strong class="'.$color.'">Trabajo a realizar</strong><br>
                '.$objSol->datSolicitud["trabajoRealizado"].'
              </p>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col col-sm-12">
              <h5 class="card-title">Presupuesto</h5>';

              $arregloPpto = $objSol->datPresupuesto;
              $totFilasPpto = count($arregloPpto);

              if($totFilasPpto==0){
                echo '
                <div class="alert alert-dismissible alert-warning">
                  <h4 class="alert-heading">Aviso!</h4>
                  <p class="mb-0">Para esta solicitud no se realizó ningún presupuesto.</p>
                </div>';
              } else {
                $ppto = 1;


                echo '
                <table class="table table-hover table-sm" id="tablaPpto" style="font-size:11px">
                  <thead>
                    <tr>
                      <th scope="col col-md-1 col-sm-12">#Parte</th>
                      <th scope="col col-md-4 col-sm-12">Concepto</th>
                      <th scope="col col-md-2 col-sm-12" style="text-align:center">Unidades</th>
                      <th scope="col col-md-2 col-sm-12" style="text-align:right">Precio</th>
                      <th scope="col col-md-2 col-sm-12" style="text-align:right">Importe</th>
                    </tr>
                  </thead>
                  <tbody>';
                foreach($arregloPpto as $columnasPpto) {
                  // $c=1;
                  // $totalDeColumnas=sizeof($columnasPpto);
                  echo 
                  '<tr>
                    <td>'.$columnasPpto["numeroDeParte"].'</td>
                    <td>'.$columnasPpto["concepto"].'</td>
                    <td style="text-align:center">'.$columnasPpto["unidades"].'</td>
                    <td style="text-align:right">'.number_format($columnasPpto["precio"],2).'</td>
                    <td style="text-align:right">'.number_format($columnasPpto["subtotal"],2).'</td>
                  </tr>';                  
                  // if($ppto>$totalDeColumnas){
                    // break;
                  // }
                  $ppto++;
                }

            echo '
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">Subtotal</td>
                    <th style="text-align:right">'.number_format($objSol->datTotales["Subtotal"],2).'</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">Iva</td>
                    <th style="text-align:right">'.number_format($objSol->datTotales["Iva"],2).'</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">Total</td>
                    <th style="text-align:right">'.number_format($objSol->datTotales["Total"],2).'</td>
                  </tr>
                </tbody>
              </table>';
              }
echo '
        <div class="card-footer">
          <div class="row">
            <div class="col col-sm-10" align="center">
              
            </div>
          </div>
          <div class="row">
            <div class="col col-auto" >
              <button type="button" class="btn btn-secondary btn-circle" id="btnCard" onclick="javascript:window.history.back();"><i class="fas fa-chevron-circle-left"></i></button>
            </div>
            <div class="col col-auto" >
                <button type="button" class="btn btn-secondary btn-circle btn-lg" id="btnCard" onclick="imprimirSolicitud('.$objSol->datSolicitud["numeroDeOrden"].')"><i class="far fa-file-pdf"></i></button>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
';

?>
