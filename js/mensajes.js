
function borra_mensajes(){

    $(".is-invalid").removeClass("is-invalid");
    $(".invalid-feedback").remove();

}

function error_formulario (campo,mensaje) {

    $("#" + campo).addClass ("is-invalid");

    $("#group-" + campo).append ( $("<div>",{
    class: "invalid-feedback",
    text: mensaje
    }));

    
}


function error_ajax(){

    alert("danger" , "error");

}

function alert (tipo){
        $("#mensaje").append(

        '<div class="alert alert-' + tipo  + ' alert-dismissible fade show" role="alert"> <strong>Mensaje: Hubo un error</strong>' + '<button type="button" class="btn-close" data-bs-dismiss="alert"aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>'
    );

        setTimeout( function(){

                $(".alert").fadeOut(100,function(){

                    $(".alert").remove();

                });

        } ,7000);
        
}
