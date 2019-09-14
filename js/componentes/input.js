function input(tipo=text,idControl, etiqueta, placeholder='', value='',activado=true,align="") {
    var desactivado='';
    if(activado==true){
        desactivado='';
    } else {
        desactivado='disabled=""';
    }
    var control = '<div class="form-group">' +
        '<label class="col-auto control-label" for="' + idControl + '">' + etiqueta + '</label> ' +
        '<div class="col-auto">' +
        '<input class="form-control form-control-sm" style="text-align:'+align+';" id="' + idControl + '" name="' + idControl + '" placeholder="' + placeholder + '" value="' + value + '" type="'+tipo+'" '+desactivado+'>' +
        '</div>' +
        '</div>';
    document.write(control);
}
