
$(document).ready(function(){

    $("#mensaje").hide();

    var texto1 = $ ("#cuadro1").html();

    $("#cuadro1").click (function(){

        $(this).html(texto1);

    });

    
    $("button").click(
        function()
        {
        
            $("#cuadro1").html("Presionaste el boton " + $(this).find("span").html()
            );
       

    }); //Fin del click

     $("#cuadro2").mouseover (function(){

        $("#mensaje").show(); //Mostrar

        //Cambiar atributos de estilo

        $(this).css("cursor","pointer");

        
        $(this).css("border-style","dashed");

        $(this).css("border-width","3px");

        $(this).css("border-color","black");

    }); //Fin del cuadro 2

    $("#cuadro2").mouseout (function(){

        $("#mensaje").hide();

         $(this).css("cursor","default");

         
         $(this).css("border-style","none");


    });     


});//Fin del $.ready