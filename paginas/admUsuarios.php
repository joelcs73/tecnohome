<?php 
include("clases/clsUsuarios.php");
$objAdmin = new clsUsuario();
?>


	 <h3 class="titulo" align="center">Administración de usuarios</h3>
	<div class="container"  align="center">
		<div class="row">
			<div class="col-md-12">
				<?php $objAdmin->listaDeUsuarios(); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<input class="col-md-1 invisible" type="text"  id="txtIdUsuario" placeholder="idUsuario">
				<input class="col-md-1 invisible" type="text"  id="txtIdArea" placeholder="idArea">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 " align="right">
				<button type="button" class="btn btn-success btn-circle" id="btnAgregar" data-toggle="modal" data-target="#modalNuevoUsuario"><span class="fa fa-plus" aria-hidden="true"></span></button>
			</div>
		</div>
	</div>
 	<!-- </nav> -->

 	<!-- Modal -->
 	<div class="modal fade" id="modalNuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNuevo">
 		<div class="modal-dialog" role="document">
 			<div class="modal-content">
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
 					<h4 class="modal-title" id="myModalLabelNuevo">Crear usuario</h4>
 				</div>
 				<div class="modal-body">
					<label>Nombre</label>
					<input type="text" name="" id="txtNombre" class="form-control input">
					<label>Usuario</label>
					<input type="text" name="" id="txtClave" class="form-control input">
					<label>Contraseña</label>
					<input type="password" name="" id="txtPassword" class="form-control input"></input>

 				</div>
 				<div class="modal-footer">
 					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
 					<button type="button" class="btn btn-primary" onclick="guardaUsuarioNuevo()">Guardar</button>
 				</div>
 			</div>
 		</div>
 	</div>

 	<div class="modal fade" id="modalEditaUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabelModifica">
 		<div class="modal-dialog" role="document">
 			<div class="modal-content">
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
 					<h4 class="modal-title" id="myModalLabelModifica">Modificar usuario</h4>
 				</div>
 				<div class="modal-body">
 					<input type="text" name="" id="txtIdUsuarioEd" class="form-control input invisible">
					<label>Nombre</label>
					<input type="text" name="" id="txtNombreEd" class="form-control input">
					<label>Clave</label>
					<input type="text" name="" id="txtClaveEd" class="form-control input">
					<label>Contraseña</label>
					<input type="password" name="" id="txtPasswordEd" class="form-control input"></input>
 				</div>
 				<div class="modal-footer">
 					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
 					<button type="button" class="btn btn-primary" onclick="guardaUsuario()">Guardar</button>
 				</div>
 			</div>
 		</div>
 	</div>

 	<div class="modal fade" id="modalOpciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabelOpciones">
 		<div class="modal-dialog" role="document">
 			<div class="modal-content">
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
 					<h4 class="modal-title" id="myModalLabelOpciones">Opciones para</h4>
 				</div>
 				<div class="modal-body">
 					<input type="text" name="" id="txtIdUsuarioOp" class="form-control input-sm invisible">
 					<div id="usuariomenu">
 						<!-- Aquí aparecerán las opciones a las que tiene acceso el usuario -->
 					</div>
 					<div id="masopciones">
 						<select id="cboOpciones" class="form-control">
 							<option value="0">Seleccione</option>
 							<?php $objAdmin->LlenaComboOpcionesDisponibles(); ?>
 						</select>
 					</div>
 				</div>
 				<div class="modal-footer">
 					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="refrescaPagina()">Cerrar</button>
 					<!-- <button type="button" class="btn btn-primary" onclick="guardaUsuario()">Guardar</button> -->
 				</div>
 			</div>
 		</div>
 	</div>



<script type="text/javascript">

$(document).ready(function(){
	$("#cboOpciones").change(function(){
		//console.log("Presionaste el id " + $("#cboOpciones").val());
		var idUsuario = $("#txtIdUsuarioOp").val();
		var idMenu = $("#cboOpciones").val();
		var titulo = $("#cboOpciones option:selected").html();
		var datos="'" +
			idMenu + "||" +
			titulo + "||" +
			idUsuario + "'";
			// console.log(datos);
			nuevaFila = '<tr class="usuario" id="opcion'+idMenu+'">' +
							'<td><span class=" grpUsuarios">'+titulo+'</span></td>' + 
							'<td class="text-right"><button class="btn btn-danger" onclick="borraOpcion('+datos+')"><span class="fa fa-times"></span></button></td>' +
						'</tr>';
		$("#tablaOpciones").append(nuevaFila);
		// #tablaOpciones está en clsComisionesDiputados en el método LlenaOpcionesDeAcceso()
		var parametros = {
			p_idUsuario : idUsuario,
			p_idMenu : idMenu,
			p_accion : "agregar"
		}
		$.ajax({
			data : parametros,
			url : "procesos/admGuardaUsuarioMenu.php",
			global:false,
			type:"POST",
			dataType:"html",
			async:true,
			cache:false,
			success: function(informacion){
				//location.reload();
			},error: function(err){
				//alert(err);
				//console.log(err);
			}
		})
	})

});


	function guardaUsuario(){
		var parametros = {
			p_idUsuario : $("#txtIdUsuarioEd").val(),
			p_nombre : $("#txtNombreEd").val(),
			p_clave : $("#txtClaveEd").val(),
			p_password : $("#txtPasswordEd").val()
		}

		$.ajax({
			data : parametros,
			url : "procesos/admGuardaUsuario.php",
			global:false,
			type:"POST",
			dataType:"html",
			async:true,
			cache:false,
			success: function(informacion){
				location.reload();
			},error: function(err){
				//alert(err);
				//console.log(err);
			}
		})

	}

	function guardaUsuarioNuevo(){
		var parametros = {
			p_idUsuario : 0,
			p_nombre : $("#txtNombre").val(),
			p_clave : $("#txtClave").val(),
			p_password : $("#txtPassword").val(),
			p_idArea : $("#cboArea").val(),
			p_idComision : $("#cboComision").val()
		}
		
		$.ajax({
			data : parametros,
			url : "procesos/admGuardaUsuario.php",
			global:false,
			type:"POST",
			dataType:"html",
			async:true,
			cache:false,
			success: function(informacion){
				location.reload();
			},error: function(err){
				//alert(err);
				//console.log(err);
			}
		})
	}

	function confirmaEliminaUsuario(datos){
		d=datos.split('||');
		idUsuario = d[0];
		nombreUsuario = d[2];
		
		$.Zebra_Dialog('Confirme que elimina a: </br> <strong>'+nombreUsuario+'</strong>', {
		    title: 'Eliminando usuario',
		    type: 'question',
		    buttons: [
		        {caption: 'Si', callback: function() { 
		        	eliminaUsuario(idUsuario);
		         }},
		        {caption: 'Cancelar', callback: function() { 
		        	return; 
		        }}
		    ]
		});


	}

	function eliminaUsuario(id){
		var parametros = {
			p_idUsuario : id
		}
		$.ajax({
			data : parametros,
			url : "procesos/admEliminaUsuario.php",
			global:false,
			type:"POST",
			dataType:"html",
			async:true,
			cache:false,
			success: function(informacion){
				location.reload();
			},error: function(err){
				//alert(err);
				//console.log(err);
			}
		})
	}

	function agregaDatosAlForm(datos){
		d=datos.split('||');
		p_idUsuario = d[0];
		p_clave = d[1];
		p_nombre = d[2];
		$("#txtIdUsuarioEd").val(p_idUsuario);
		$("#txtNombreEd").val(p_nombre);
		$("#txtClaveEd").val(p_clave);
	}

	function agregaDatosAlFormOpciones(datos){
		d=datos.split('||');
		p_idUsuario = d[0];
		p_nombre = d[2];
		$("#txtIdUsuarioOp").val(p_idUsuario);
		$("#myModalLabelOpciones").html("<h5>Opciones para: <strong>"+p_nombre+"</strong></h5>");

		var parametros = {
			idUsuario : p_idUsuario
		}
		$.ajax({
			data : parametros,
			url : "paginas/admOpcionesDeUsuario.php",
			global:false,
			type:"POST",
			dataType:"html",
			async:true,
			cache:false,
			success: function(informacion){
				$("#usuariomenu").html(informacion)
			},error: function(err){
				//alert(err);
				//console.log(err);
			}
		})
	}

	function refrescaPagina(){
		location.reload();
	}

	function borraOpcion(datos){
		d=datos.split("||");
		idUsuario = $("#txtIdUsuarioOp").val();
		idMenu = d[0];
		//p_tituloMenu = d[1];
		$("#opcion"+idMenu).remove();

		var parametros = {
			p_idUsuario : idUsuario,
			p_idMenu : idMenu,
			p_accion : "eliminar"
		}
		$.ajax({
			data : parametros,
			url : "procesos/admGuardaUsuarioMenu.php",
			global:false,
			type:"POST",
			dataType:"html",
			async:true,
			cache:false,
			success: function(informacion){
				//location.reload();
			},error: function(err){
				//alert(err);
				//console.log(err);
			}
		})
	}

</script>
