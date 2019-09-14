<?php 
include("../clases/clsUsuarios.php");

$idUsuario = $_POST["p_idUsuario"];
$idMenu = $_POST["p_idMenu"];
$accion = $_POST["p_accion"];

$objAdmin = new clsUsuario();

$objAdmin->guardaUsuarioMenu($idUsuario,$idMenu,$accion);
?>