function textarea(idControlTexto,etiqueta,placeholder,rows,value){
    var control='';
    if(etiqueta!=""){
        control = 
        '<div class="form-group">'+
            '<label for="'+idControlTexto+'">'+etiqueta+'</label>'+
            '<textarea class="form-control" id="'+idControlTexto+'" placeholder="'+placeholder+'" rows="'+rows+'">'+value+'</textarea>'+
        '</div>';
    } else {
        var control = 
        '<div class="form-group">'+
            '<textarea class="form-control" id="'+idControlTexto+'" placeholder="'+placeholder+'" rows="'+rows+'">'+value+'</textarea>'+
        '</div>';
    }
    document.write(control);
}