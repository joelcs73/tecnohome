<?php
include_once '../clases/funciones.php';
include_once '../clases/clsSolicitud.php';
// include_once '../../clases/clsConexion.php';

$oSol = new clsSolicitud();

$oSol->setNumeroDeOrden($_POST["p01OrdenNumero"]);
$oSol->setFechaDeOrden($_POST["p02OrdenFechaOrden"]);
$oSol->setFechaDeVisita($_POST["p03OrdenFechaVisita"]);
$oSol->setNombreDelCliente($_POST["p04ClienteNombre"]);
$oSol->setDireccionDelCliente($_POST["p05ClienteDireccion"]);
$oSol->setTelefonoDelCliente($_POST["p06ClienteTelefono"]);
$oSol->setCelularDelCliente($_POST["p07ClienteCelular"]);
$oSol->setCorreoDelCliente($_POST["p08ClienteCorreo"]);
$oSol->setDescripcionDelProducto($_POST["p09PdtoDescripcion"]);
$oSol->setMarcaDelProducto($_POST["p10PdtoMarca"]);
$oSol->setModeloDelProducto($_POST["p11PdtoModelo"]);
$oSol->setSerieDelProducto($_POST["p12PdtoSerie"]);
$oSol->setFallaDelProducto($_POST["p13FallaProducto"]);
$oSol->setDiagnosticoTecnico($_POST["p14DiagnosticoTecnico"]);
$oSol->setTrabajo($_POST["p15Trabajo"]);
$oSol->setIvaUtilizado($_POST["p16IvaUtilizado"]);
$oSol->setJsonTablaPresupuesto($_POST["p17JsonTablaPpto"]);

$oSol->guardaSolicitud();

?>