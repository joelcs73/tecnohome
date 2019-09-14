<?php 
include("../clases/clsUsuarios.php");

$id = $_POST["idUsuario"];
$password = $_POST["contrasena"];

$objUsuario = new clsUsuario();

$objUsuario->guardaContrasena($password,$id);
?>