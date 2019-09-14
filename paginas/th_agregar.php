<?php 
include_once './clases/clsSolicitud.php';
include_once './clases/funciones.php';
$oSol = new clsSolicitud();
?>

<h3 class="titulo" align="center">Agregar</h3>
<div id="divUltimoNumeroDeOrden" hidden><?php devuelveUltimoId('idOrden','ordendeservicio','idOrden');?></div>
<div id="divPorcentajeDeIva" hidden><?php devuelveDato('porcentajeDeIva','configuracion');?></div>
<div class="container" >
<div class="row">
    <div class="col col-12" style="text-align:right">
      <label class="col-auto control-label" for="btnGuarda">Guardar solicitud</label> 
      <button type="button" onClick="guardaSolicitud()" id="btnGuarda" class="btn btn-primary btn-circle"><span class="fas fa-check" aria-hidden="true"></span></button>
    </div>
</div>
<div class="row">
  <div class="col">
    <div class="card bg-light mb-2 col-12">
        <div class="card-header"><h4>Datos de la orden</h4></div>
        <div class="card-body">
          <div class="row">
              <div class="col-md-4">
                  <script>input('text','txtNumeroDeOrden','Orden','',$("#divUltimoNumeroDeOrden").html(),false);</script>
              </div>
              <div class="col-md-4">
                  <script>input('date','txtFechaDeOrden','Fecha de orden','',fechaActualCorta('amd'));</script>
              </div>
              <div class="col-md-4">
                  <script>input('date','txtFechaDeVisita','Fecha de visita','',fechaActualCorta('amd'));</script>
              </div>
          </div>
        </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
    <div class="card bg-light mb-2 col-12" >
    <div class="card-header"><h4>Datos del cliente</h4></div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-3">
                <script>input('text','txtNombreCliente','Nombre','','');</script>
            </div>
            <div class="col-md-3">
                <script>input('text','txtDireccionCliente','Dirección','','');</script>
            </div>
            <div class="col-md-2">
                <script>input('text','txtTelefonoCliente','Teléfono','','');</script>
            </div>
            <div class="col-md-2">
                <script>input('text','txtCelularCliente','Celular','','');</script>
            </div>
            <div class="col-md-2">
                <script>input('text','txtCorreoCliente','Correo e.','','');</script>
            </div>
        </div>
    </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
    <div class="card bg-light mb-2 col-12" >
    <div class="card-header"><h4>Datos del producto</h4></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <script>input('text','txtDescripcionDelProducto','Descripción','','');</script>
            </div>
            <div class="col-md-3">
                <script>input('text','txtMarcaDelProducto','Marca','','');</script>
            </div>
            <div class="col-md-3">
                <script>input('text','txtModeloDelProducto','Modelo','','');</script>
            </div>
            <div class="col-md-3">
                <script>input('text','txtSerieDelProducto','Serie','','');</script>
            </div>
        </div>
    </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="card bg-light mb-2 col-12" >
      <div class="card-header"><h4>Falla</h4></div>
      <div class="card-body">
        <script>textarea('txtFallaProducto','','',4,'');</script>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card bg-light mb-2 col-12" >
      <div class="card-header"><h4>Diagnóstico técnico</h4></div>
      <div class="card-body">
        <script>textarea('txtDiagnosticoTecnico','','',4,'');</script>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card bg-light mb-2 col-12" >
      <div class="card-header"><h4>Trabajo a realizar</h4></div>
      <div class="card-body">
        <script>textarea('txtTrabajo','','',4,'');</script>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col col-sm-12">
      <div class="card bg-light mb-2 col-12" >
          <div class="card-header"><h4>Presupuesto</h4></div>
          <div class="card-body">
            <div class="row">
              <div class="col col-lg-4 col-md-12 col-sm-12" >
                <div class="col col-lg-6 col-md-12 col-sm-12"><script>input('number','txtPptoNumeroDeParte','No. de parte','','');</script></div>
                <div class="col col-lg-12 col-md-12 col-sm-12"><script>input('text','txtPptoConcepto','Concepto','','');</script></div>
                <div class="col col-lg-6 col-md-12 col-sm-12"><script>input('number','txtPptoUnidades','Unidades','','');</script></div>
                <div class="col col-lg-6 col-md-12 col-sm-12"><script>input('number','txtPptoPrecio','Precio','','');</script></div>
                <div class="col col-sm-12" display:block><button id="btnAgregaFila" type="button" class="btn btn-primary btn-block">Agregar fila al Ppto <i class="fas fa-plus-circle"></i></button></div>
              </div>

              <div class="col col-lg-6 col-md-12 col-sm-12">
                <table class="table table-hover table-sm" id="tablaPpto" style="font-size:11px">
                  <thead>
                    <tr>
                      <th scope="col col-md-1 col-sm-12">#Parte</th>
                      <th scope="col col-md-4 col-sm-12">Concepto</th>
                      <th scope="col col-md-2 col-sm-12" style="text-align:center">Unidades</th>
                      <th scope="col col-md-2 col-sm-12" style="text-align:right">Precio</th>
                      <th scope="col col-md-2 col-sm-12" style="text-align:right">Importe</th>
                      <th scope="col col-md-1 col-sm-12"></th>
                    </tr>
                  </thead>
                  <tbody id="filasNuevas">

                  </tbody>
                </table>
              </div>

              <div class="col col-lg-2 col-md-12 col-sm-12 justify-content-end">
                <div class="row">
                <ul class="list-group col-sm-12">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Subtotal
                    <span class="badge badge-primary badge-pill" id="txtSubtotal">0.00</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center" id="liIva">
                    IVA
                    <span class="badge badge-primary badge-pill" id="txtIva">0.00</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    TOTAL
                    <span class="badge badge-primary badge-pill" id="txtTotal">0.00</span>
                  </li>
                </ul>
                <div class="invisible"><script>input('text','txtPorcentajeDeIva','','',$("#divPorcentajeDeIva").html(),false)</script></div>
              </div>
            </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col col-12" style="text-align:right">
      <label class="col-auto control-label" for="btnGuarda">Guardar solicitud</label> 
      <button type="button" onClick="guardaSolicitud()" id="btnGuarda" class="btn btn-primary btn-circle"><span class="fas fa-check" aria-hidden="true"></span></button>
    </div>
</div>
  </div>
<script>

  $("#btnAgregaFila").click(function(){
    // La función avisoFaltanDatos() está establecida en guardaSolicitud.js
    if($("#txtPptoNumeroDeParte").val().trim()==""){avisoFaltanDatos("Capture Número de parte"); return;}
    if($("#txtPptoConcepto").val().trim()==""){avisoFaltanDatos("Capture Concepto"); return;}
    if($("#txtPptoUnidades").val().trim()==""){avisoFaltanDatos("Capture Unidades"); return;}
    if($("#txtPptoPrecio").val().trim()==""){avisoFaltanDatos("Capture Precio"); return;}
    var intUnidades = parseInt($("#txtPptoUnidades").val());
    var fltPrecio = parseFloat($("#txtPptoPrecio").val());
    var importe = intUnidades*fltPrecio;
    nuevaFila=
     '<tr class="nuevaFila" style="font-size:.7rem">'+
       '<td class="Parte">'+
         $("#txtPptoNumeroDeParte").val()+
       '</td>'+
       '<td class="Concepto">'+
         $("#txtPptoConcepto").val()+
       '</td>'+
       '<td class="Unidades" style="text-align:center">'+
         $("#txtPptoUnidades").val()+
       '</td>'+
       '<td class="Precio" style="text-align:right">'+
          number_format($("#txtPptoPrecio").val(),2)+
       '</td>'+
       '<td class="Importe" style="text-align:right">'+
          number_format(importe,2)+
       '</td>'+
       '<td style="text-align:right">'+
         '<button id="btnBorraFila" type="button" class="btn btn-primary btn-sm" onclick="borraFila(this)"><i class="fas fa-trash"></i></button>'+
       '</td>'+
     '</tr>';
     
    $("#filasNuevas").append(nuevaFila);
    totaliza(Number(importe));

     $("#txtPptoNumeroDeParte").val("");
     $("#txtPptoConcepto").val("");
     $("#txtPptoUnidades").val("");
     $("#txtPptoPrecio").val("");
     $("#txtPptoNumeroDeParte").focus();
  })

    function borraFila(estaFila){
      fila = $(estaFila).closest('tr');
      var importe = fila.find('.Importe').text();

      // Debemos quitar las comas del importe, porque lo obtenemos como texto.
      // Al quererlo convertir a Number, si tiene comas, se queda como texto
      // y no se harán bien las operaciones.
      importe = importe.replace(',','');
      importe = Number(importe);

      totaliza(importe*(-1));

      fila.remove();

      $("#txtPptoNumeroDeParte").focus();
  }

  function totaliza(importe){
    var txtSubtotal = $("#txtSubtotal").html();

    // Debemos quitar las comas del importe, porque lo obtenemos como texto.
    // Al quererlo convertir a Number, si tiene comas, se queda como texto
    // y no se harán bien las operaciones.
    txtSubtotal = txtSubtotal.replace(',','');
    var subTotalAnt = Number(parseFloat(txtSubtotal));
    var subTotalNvo = Number(parseFloat(subTotalAnt+importe));
    
    $("#txtSubtotal").html(number_format(subTotalNvo,2));

    // El iva está oculto en txtPorcentajeDeIva en este archivo
    // debajo de la lista donde están los textos de Subtotal, iva y total
    var porcIva = Number($("#txtPorcentajeDeIva").val())/100;
    var iva = subTotalNvo*porcIva;
    $("#txtIva").html(number_format(iva,2));

    var total = subTotalNvo+iva;
     $("#txtTotal").html(number_format(total,2));

    // console.log('Importe que se agrega o elimina:'+importe+' ('+typeof importe+')  | Subtotal anterior float:'+subTotalAnt+' ('+typeof subTotalAnt+')  | Subtotal Nuevo Float:'+subTotalNvo+' ('+typeof subTotalNvo+')  |  IVA Float:'+iva+' ('+typeof iva+')  Total Float:'+total+' ('+typeof total+')');
  }
</script>