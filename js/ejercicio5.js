$(document).ready(function(){
    //alert("hola");

    $("#texto-a-ocultar").hide();

    $("#mayor").prop("checked", false);

    $("#mayor").click(function(){
        borra_mensajes();
        //VALIDACION DEL NOMBRE

        if($("#nombre").val() == ""){

            $("#texto-a-ocultar").hide();
            
            error_formulario("nombre", "Debes escribir el nombre");
        $(this).prop("checked", false);
        }else{

            if ($(this).prop("checked")){
                $("#texto-a-ocultar").fadeIn();
             }else{
                $("#texto-a-ocultar").fadeOut();
        }
        }
        
    }); //FINN del $("#mayor").click

    $("#nombre").click(borra_mensajes);

}); //FIN DEL $.ready