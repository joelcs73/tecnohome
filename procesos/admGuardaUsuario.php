<?php 
include("../clases/clsUsuarios.php");

$id = $_POST["p_idUsuario"];
$nombre = $_POST["p_nombre"];
$clave = $_POST["p_clave"];
$password = $_POST["p_password"];

$objUsuario = new clsUsuario();

$objUsuario->guardaUsuario($id,$clave,$password,$nombre);
?>