//FUNCIONES EXTERNAS
function borra_mensajes(){
    $(".is-invalid").removeClass("is-invalid");
    $(".invalid-feedback").remove(); //Quitar de la pagina
}

function error_formulario(campo, mensaje){
    $("#"+campo).addClass("is-invalid");
    $("#group-"+campo).append($("<div>",{

        class : "invalid-feedback",
        text : mensaje

    }));
}