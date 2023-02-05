    //Ya no es html sino javascript

    var x = 3;
    var y = 5;
    var z = x+y;

   // alert ("La suma de " + x + " más " + y + " es igual a "+ z  )

   document.getElementById("letrero").innerHTML="La suma de " + x + " más " + y + " es igual a "+ z ;

   function guardar (){

    var dato = document.getElementById("texto").value;
    document.getElementById("letrero").innerHTML=dato;

   }

   
   function limpiar (){

    document.getElementById("texto").value="";
    document.getElementById("texto").placeholder="Ahora escribe otra cosa ";
    document.getElementById("letrero").innerHTML="";

   }