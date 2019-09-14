<?php session_start();
// include("clases/conexion.php");
include_once "clases/clsConexion.php";
$oCon = new clsConexion();
$oCon->abrir_conexion();

$usuario = $_POST["usu"];
$clave = md5($_POST["cla"]);


//echo $cEncrip;
$qry = "
SELECT 
idUsuario, 
clave, 
pwd, 
nombreUsuario 
FROM 
admusuarios 
WHERE clave='".$usuario."' and pwd='".$clave."' 
";

//echo $qry;

$con = $oCon->obtener_conexion();

$busc_ = mysqli_query($con,$qry);
// echo $qry;
$fres = mysqli_num_rows($busc_);
if($fres==0)
{
	header("Location: index.php");
}
else
{
	$us = mysqli_fetch_array($busc_);
	$_SESSION["idUsuario"] = $us["idUsuario"];
	$_SESSION["usuario"] = $us["clave"];
	$_SESSION["nombreUsuario"] = $us["nombreUsuario"];
	$_SESSION["bd"] = DB_NAME;

	header("Location: index.php?p=inicio");
	$oCon->cerrar_conexion();
}?>
