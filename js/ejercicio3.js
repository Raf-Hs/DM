
$(document).ready(function(){

    //Evita el comportamiento por default

    //Util en links y submits


    $("a").click (function(evento){

        evento.preventDefault();



    $("#mensaje").html ("Parece que quieres ir a " + $(this).html()+ ", pero...");


    setTimeout(function () {

        setTimeout(function () {

            $(location).attr("href","https://youtube.com");

        }, 2000);


        $("#mensaje").html ("Te voy a mandar a ver videos");

        
    }, 2000);
   
    


        }); //Parece que quieres ir a ...

});//Fin del $.ready