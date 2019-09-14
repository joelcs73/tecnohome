<?php
if(!isset($_SESSION)){
	@session_start();
}
$usu = $_SESSION["usuario"];
$p = $_GET["p"];
$idProv = $_GET["idProv"];
$e = $_GET["e"];
// $n = $_GET["n"];
	
	// $pag="paginas/".$p.".php";
	$pag="paginas/".$p;

	if($p==""){$pag="paginas/inicio.html";}
	if($p=="inicio"){$pag="paginas/inicio.html";}
	if($p=="cambioContrasena"){$pag="paginas/admCambiarContrasena.php";}
	if($p=="solicitudMostrada"){$pag="paginas/solicitudMostrada.php";}

?>
<!DOCTYPE html>
<html>
<head>

	<title>Tecno Home</title>

	<?php
	include("meta.php");
	include("estilos.php");
	include("scripts.php");
	?>

</head>
<!-- <body oncontextmenu="return false;"> -->
<body>
	<!-- <div class="container-fluid"> -->
	<div class="">
		<?php 
		if($usu==""){
			include("login.php");
		} else { ?>


			<nav>
				<?php 
				include("menu2.php");
				?>
			</nav>


			<!-- <section class="container-fluid"> -->
			<section class="container" style="margin-bottom: 70px;  margin-top: 58px;">
				<?php  
				@include($pag);
				?>
				
			</section>

			<footer class="text-center ">
				<p><small>
					<!-- Rodríguez Clara No. 203-A Col. Felipe Carrillo Puerto. Xalapa, Ver.  
					|  <span class="fa fa-phone"></span> 2284063365,  2281580850 </br> -->
					Versión 8.19 - Bootstrap 4.2<br>
					Desarrollo: LSCA Joel Clemente Serrano </br>
					joelcs73@gmail.com
				</small></p>
			</footer>
		<?php 	}?>

		</div>
</body>
</html>

<script>
// $("body").bind("copy paste",function(event){var navType = $("body").attr("data-browsername");
// if (navType=="MSIE"){
//  window.clipboardData.setData("Text","No se vale copiar. Muchas gracias.");}
// else{
//  event.originalEvent.clipboardData.setData("Text","No se vale copiar. Muchas gracias."); 
// }
// event.preventDefault();
// return false;});
</script>