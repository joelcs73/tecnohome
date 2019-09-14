	<!-- ENCABEZADO.PHP -->
	<!-- <img src="imagenes/servicio_medico.jpg" class="rounded mx-auto d-block" style="width:800px; height:41px"> -->
	<div class="row">
		<div class="col-md-2 text-center align-self-center">
			<div>
				<img alt="Bootstrap Image Preview" style="width:160px; height:120px" src="imagenes/logotipo.jpg" />
			</div>
		</div>
		<div class="col-md-7 text-center align-self-center">
			<h1>TECNO HOME</h1>
			<!-- <div clas4="jumbotron">
				<h1 class="display-1">TECNO HOME</h1>
			</div> -->
		</div>
		<div class="col-md-3 text-center text-default align-self-center">
			<h4>
			<?php if($usu!=""){
				echo "Usuario:</br>".trim($_SESSION["nombreUsuario"]);
			}?>
			</h4>
		</div>
	</div>