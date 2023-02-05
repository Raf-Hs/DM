
$(document).ready(function(){


    var ancho = $("#cuadro").css("border-width")
    var color = $("#cuadro").css("border-color")
    var style = $("#cuadro").css("border-style")

    $("#btn-css").click (function(){

        $("#cuadro")
        .css("border-width","3px")
        .css("border-color","dark")
        .css("border-style","dashed")
        .removeClass("bg-secondary bg-opacity-25")
        .css("background-color","rgb(255,87,51)");


        }); //Findel boton 

        
        $("#btn-clases").click(function(){

            $("#cuadro").removeClass("bg-secondary bg-opacity-25")
            .addClass("verde_limon text-white");
     

        }
        );


        

    $("#btn-restaurar").click (function(){

            $("#cuadro").css("border-width",ancho)
            .css("border-color",color)
            .css("border-style",style);
    

            $("#cuadro").addClass("bg-secondary bg-opacity-25")
            .removeClass("verde_limon text-white");
            }); //Parece que quieres ir a ...





});//Fin del $.ready