function confirmation(idActividad) {

  //Si el mensaje se responde afirmativamente se va a la página adminActividades pasandole el parametro eliminar
    var answer = confirm("¿Está seguro de que desea eliminar esta entrada?")
    if (answer){
        location.href ='adminActividades.php?eliminar='+idActividad;
    }
    else{
        //no hacer nada
    }
}
