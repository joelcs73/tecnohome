<?php 
include_once("../clases/clsUsuarios.php");

$id = $_POST["p_idUsuario"];

$objAdmin = new clsUsuario();

$objAdmin->eliminaUsuario($id);
?>