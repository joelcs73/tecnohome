function guardaSolicitud(){
    parametros={
        p01OrdenNumero : $("#txtNumeroDeOrden").val(),
        p02OrdenFechaOrden : $("#txtFechaDeOrden").val(),
        p03OrdenFechaVisita : $("#txtFechaDeVisita").val(),
        p04ClienteNombre : $("#txtNombreCliente").val(),
        p05ClienteDireccion : $("#txtDireccionCliente").val(),
        p06ClienteTelefono : $("#txtTelefonoCliente").val(),
        p07ClienteCelular : $("#txtCelularCliente").val(),
        p08ClienteCorreo : $("#txtCorreoCliente").val(),
        p09PdtoDescripcion : $("#txtDescripcionDelProducto").val(),
        p10PdtoMarca : $("#txtMarcaDelProducto").val(),
        p11PdtoModelo : $("#txtModeloDelProducto").val(),
        p12PdtoSerie : $("#txtSerieDelProducto").val(),
        p13FallaProducto : $("#txtFallaProducto").val(),
        p14DiagnosticoTecnico : $("#txtDiagnosticoTecnico").val(),
        p15Trabajo : $("#txtTrabajo").val(),
        p16IvaUtilizado : $("#txtPorcentajeDeIva").val(),
        p17JsonTablaPpto : devuelveJsonPpto('tablaPpto')
    }
    if(parametros["p04ClienteNombre"]==""){avisoFaltanDatos("Capture nombre del cliente"); return;}
    if(parametros["p05ClienteDireccion"]==""){avisoFaltanDatos("Capture dirección del cliente"); return;}
    if(parametros["p09PdtoDescripcion"]==""){avisoFaltanDatos("Capture descripción del producto"); return;}
    if(parametros["p10PdtoMarca"]==""){avisoFaltanDatos("Capture marca del producto"); return;}
    if(parametros["p13FallaProducto"]==""){avisoFaltanDatos("Capture falla del producto"); return;}
    if(parametros["p14DiagnosticoTecnico"]==""){avisoFaltanDatos("Capture diagnóstico técnico"); return;}
// TODO: cambiar
    $.ajax({
		data : parametros,
		url : "./procesos/guardaSolicitud.php",
		global:false,
		type:"POST",
		dataType:"html",
		async:true,
		cache:false,
		success: function(resultado){
			$.Zebra_Dialog('Registro guardado', {
				title: 'Tecno Home',
                type: 'confirmation',
                width: '280'
			});
        },error: function(err){
        //alert(err);
        //console.log(err);
        }
    })
}

function devuelveJsonPpto(idTabla){
    // idTabla es #tablaPpto que se encuentra en th_ftoSolicitudServicio.html
    var arregloJson = [];
    $("[id*="+idTabla+"] .nuevaFila").each(function () {
        var datosPpto = {};
        datosPpto.Parte = $(this).closest('tr').find('.Parte').text().trim();
        datosPpto.Concepto = $(this).closest('tr').find('.Concepto').text().trim();
        datosPpto.Unidades = $(this).closest('tr').find('.Unidades').text().trim();
        datosPpto.Precio = $(this).closest('tr').find('.Precio').text().trim().replace(',','');
        datosPpto.Importe = $(this).closest('tr').find('.Importe').text().trim().replace(',','');
        arregloJson.push(datosPpto);
    });
    return arregloJson;
}

function avisoFaltanDatos(aviso){
    $.Zebra_Dialog(aviso, {
        title: 'Tecno Home',
        type: 'error',
        width: '280'
    });
}

