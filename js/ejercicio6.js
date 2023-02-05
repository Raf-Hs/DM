
$(document).ready(function(){

        $("#btn-ocultar").click(function(){

          

            $("#cuadro1").fadeOut(5000,function()
            {
                alert("Acabo la animación");
                $("#btn-ocultar").prop ("disabled",true);
                $("#btn-mostrar").prop ("disabled",false);
            });

        });
        

        
        $("#btn-mostrar").click(function(){

            $(this).prop ("disabled",true);

            $("#btn-ocultar").prop ("disabled",false);

            $("#cuadro1").fadeIn(300);


          
        });






        $("#btn-mover").click(function(){
            $("#cuadro2")
            .css ("width","550px")
            .fadeOut(200,function()
            {
                $(this)
                .css ("position","absolute")
                .css ("left",800)
                .css ("top",450)
                .fadeIn(500);
            });

        });

       

      
        $("#btn-contra").click(function(){
          if(  $("#contra").attr("type") == "password" ){

            $("#contra").attr("type","text");

            $(this)
            .find("i")
            .removeClass("fa-eye")
            .addClass("fa-eye-slash")
          }
          else{

            $("#contra").attr("type","password");

            $(this)
            .find("i")
            .removeClass("fa-eye-slash")
            .addClass("fa-eye")
          }

        });
                 
       
    });
            