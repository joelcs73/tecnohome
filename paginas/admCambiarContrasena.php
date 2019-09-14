<h3 class="titulo" align="center">Cambio de contraseña</h3>
    <div class="container"  align="center" style="">
    	<div class="card bg-light mb-3" style="max-width: 20rem;" align="left">
		<div class="card-header">Proporcione la contraseña</div>
			<div class="card-body">

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-12 control-label" for="txtNombreUsuario">Nombre</label>  
					<div class="col-md-12">
						<input id="txtNombreUsuario" name="txtNombreUsuario" type="text" placeholder="Nombre completo" class="form-control input-md" value="<?php echo $_SESSION["nombreUsuario"];?>" readonly>
					</div>
				</div>

				<!-- Password input-->
				<div class="form-group">
					<label class="col-md-12 control-label" for="txtContrasena">Contraseña</label>
					<div class="col-md-12">
						<input id="txtContrasena" name="txtContrasena" type="password" placeholder="Mín. 8 caracteres" class="form-control input-md">
					</div>
				</div>

	    		<!-- Button -->
				<div class="form-group">
					<!-- <label class="col-md-12 control-label" for="btnGuardar">Guardar</label> -->
					<div class="col-md-12">
						<button id="btnGuardar" type="button" name="btnGuardar" class="btn btn-primary"><span class="fa fa-check"></span>   Guardar </button>
					</div>
				</div>
			</div>

			<!-- <div class="card-footer text-muted">
				<div id="idMsg" class="alert alert-dismissible alert-danger invisible">
    				<strong id="etiqueta">Atención!</strong><p id="mensaje"></p>
				</div>
  			</div> -->
		</div>
    </div>
<input id="txtIdUsuario" name="txtIdUsuario" type="text" class="form-control input-md invisible" value="<?php echo $_SESSION["idUsuario"]; ?>" readonly>
    <script>
        $(document).ready(function(){
            $('#btnGuardar').click(function(){
                if ($("#txtContrasena").val()!=""){
                    if($("#txtContrasena").val().length<8){
                        // La función avisoFaltanDatos() está establecida en guardaSolicitud.js
                        avisoFaltanDatos("La contraseña debe tener 8 o más caracteres"); return;
						// $("#idMsg").attr("class","alert alert-dismissible alert-danger");
                        // $("#mensaje").html("La contraseña debe tener 8 o más caracteres");
                        return;
                    } else {
                        $("#idMsg").attr("class","alert alert-dismissible alert-danger invisible");
                    }
                } else {
                    return;
                }

                var datos = {
                    idUsuario : $("#txtIdUsuario").val(),
                    contrasena : $("#txtContrasena").val(),
                };
                $.ajax({
                    data : datos,
                    url : 'procesos/admGuardaContrasena.php',
                    global: false,
                    type:"POST",
                    dataType: "json",
                    async: true
                }).done(function(resp){
                    // console.log(resp);
                    if(resp.resultado==1){
                        $.Zebra_Dialog('Contraseña guardada con éxito', {
                            title: 'Confirmación',
                            type: 'confirmation',
                            onClose: function(){
                                window.location="index.php?p=inicio";
                            }
                        });
                        
                    } else {
                        $.Zebra_Dialog('Algo salió mal.</br>No se pudo guardar la contraseña.</br><strong>'+resp.cadena+'</strong>', {
                            title: 'Error',
                            type: 'error',
                        });
                    }
                });
            });
        })
    </script>