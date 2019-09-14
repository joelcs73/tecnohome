function fechaActualCorta(formato='dma'){
  // Formato: 'amd' = año-mes-dia
  // Formato: 'dma' o nada = dia/mes/año
  var f = new Date(); 
  var numeroMes = new Array();
  numeroMes[0] = "01";
  numeroMes[1] = "02";
  numeroMes[2] = "03";
  numeroMes[3] = "04";
  numeroMes[4] = "05";
  numeroMes[5] = "06";
  numeroMes[6] = "07";
  numeroMes[7] = "08";
  numeroMes[8] = "09";
  numeroMes[9] = "10";
  numeroMes[10] = "11";
  numeroMes[11] = "12";
  if(formato=='amd'){
    return f.getFullYear()+'-'+numeroMes[f.getMonth()]+'-'+strzero(f.getDate(),2);
  } else{
    return strzero(f.getDate(),2)+'/'+numeroMes[f.getMonth()]+'/'+f.getFullYear();
  }
  
}

function strzero(valor,posiciones){
  var tipo = typeof valor;
  if (tipo=='number'){valor = valor.toString();}
  var lenVar = valor.length;
	var strCadenaCeros="";
	for(ceros=1; ceros<=(posiciones-lenVar); ceros++){
		strCadenaCeros=strCadenaCeros+"0";
	}
	return strCadenaCeros+valor;
}

function fechaActualCortaConLetra(){
  var f = new Date(); 
  var numeroMes = new Array();
  numeroMes[0] = "Ene";
  numeroMes[1] = "Feb";
  numeroMes[2] = "Mar";
  numeroMes[3] = "Abr";
  numeroMes[4] = "May";
  numeroMes[5] = "Jun";
  numeroMes[6] = "Jul";
  numeroMes[7] = "Ago";
  numeroMes[8] = "Sep";
  numeroMes[9] = "Oct";
  numeroMes[10] = "Nov";
  numeroMes[11] = "Dic";
  return f.getDate()+'/'+numeroMes[f.getMonth()]+'/'+f.getFullYear();
}

function Abrir_ventana (pagina){
	var opciones="toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=yes, width=1080, height=1200, top=85, left=140";
	window.open(pagina,"",opciones);
}

function number_format(amount, decimals) {

  amount += ''; // por si pasan un numero en vez de un string
  amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

  decimals = decimals || 0; // por si la variable no fue fue pasada

  // si no es un numero o es igual a cero retorno el mismo cero
  if (isNaN(amount) || amount === 0) 
      return parseFloat(0).toFixed(decimals);

  // si es mayor o menor que cero retorno el valor formateado como numero
  amount = '' + amount.toFixed(decimals);

  var amount_parts = amount.split('.'),
      regexp = /(\d+)(\d{3})/;

  while (regexp.test(amount_parts[0]))
      amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

  return amount_parts.join('.');
}

function imprimirSolicitud(orden){
  var pagina = "paginas/rptSolicitudPdf.php?no="+orden;
  Abrir_ventana(pagina);
}