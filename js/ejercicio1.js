/*Esto es Jquery
 
 $(document).ready(hola);


 //Funcion que programa el evento onload

 function hola(){

    alert ("Hola Jquery")

 }
*/


//Sintaxis de una función anonima de JQUERY
//incluyendo eventos y acciones al cargar la pagina
$(document).ready(function(){

   // alert("Hola usando función anonima");

    var textoOriginal  = $("#texto-1").html();
    var original = true;

    $("#btn-cambia-texto").click(
        function()
        {
        if(original){
            $("#texto-1").html("Ahora es texto creado con Jquery");    
            original =false  
        }
        else{
            $("#texto-1").html(textoOriginal);
            original = true;  

        }

    }); //Fin del click


    $(".btn-color").click(function(){
        $("#texto-2").html(
        "Presionaste el botón " + 
        $(this).html()
        );

        $(this).prop("disabled",true);

        $(this).removeClass("btn-primary btn-secondary  btn-dark btn-light btn-warning btn-success btn-info btn-danger ");


        $(this).addClass("btn-secondary");

    });


});//Fin del $.ready