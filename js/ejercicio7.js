
$(document).ready(function(){

      var texto1= $("#texto-1").html();
      var texto2= $("#texto-2").html();
      var texto3= $("#texto-3").html();

        $(".call-ajax").mouseover(function(){

          $(this).css("cursor","pointer");

        });
        
        $(".call-ajax").mouseout(function(){

            $(this).css("cursor","default");

            $("#texto-1").html(texto1);
            $("#texto-2").html(texto2);
            $("#texto-3").html(texto3);


          });
        
          
        $("#ajax-1").mouseover(function(){

            $.ajax({
             
                "url" : "contenido_ajax.php"

            })
            .done(function(response){
                $("#texto-1").html( response );
            })
            .fail(function(){
                alert("Hubo un error en ajax");
            });

        });//Findel del ajax1

        $("form").submit(function( e ){
        
        e.preventDefault();
        borra_mensajes();

            if($("#nombre").val()==""){

                error_formulario("nombre","Escribe el nombre");
                return false;

            }

            else if($("#edad").val()==""){

                error_formulario("edad","Escribe la edad");
                return false;

            }

          
            $.ajax({
             
                "url" : "contenido_ajax.php",
                "type":"post",
                "data": {

                    "nombre": $("#nombre").val(),
                    "edad":$("#edad").val(),

                }

            })
            .done(function(response){
                $("#texto-2").html( response );
            })
            .fail(function(){
                alert("Hubo un error en ajax");
            });




            return true;
            
        });

        $("input").click(borra_mensajes);


        $("#ajax-3").mouseover(function(){

            $.ajax({
             
                "url" : "bd_ajax.php",
                "dataType": "json", 

            })
            .done(function( response ){
                $("#texto-3")
                .html("")
                .append( $("<h5>",{
                "text" : "Lista de productos"
             }))

             .append ($ ("<ol>"));
              

                /*
                Recorre cada elemento del objeto JSON y lo procesa como un
                "nomproducto"
                */
                $.each( response, function(indice,nomproducto){
                    $("#texto-3")
                        .find("ol")
                        .append($("<li>",{
                            "text":nomproducto
                        }));
                    

                });
            })
            .fail( error_ajax);

        });//Findel del ajax3


});


