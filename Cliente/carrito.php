<?php
   try {
    $conexion = new PDO('mysql:host=localhost;dbname=luran','root', '');
} catch (PDOException $e) {
    echo "Error XXX:" . $e->getMessage();
    
}

session_start();


$mensaje="";

if(isset($_POST['btnAccion'])){

switch($_POST['btnAccion']){

    case 'Agregar':
            if($_POST['id']){
            $ID= $_POST['id']; 
            //$mensaje.="Ok ID correcto".$ID."<br/>" ;
            }
            else{
               // $mensaje.="UPS ID incorrecto".$ID."<br/>"; break;
            }
           
            if($_POST['nombre']){
                $NOMBRE= $_POST['nombre']; 
                //$mensaje.="Ok Nombre correcto ".$NOMBRE."<br/>" ;
                }
                else{
                   // $mensaje.="UPS Nombre incorrecto ".$NOMBRE."<br/>"; break;
                } 
                
            if($_POST['precio']){
                $PRECIO= $_POST['precio']; 
               // $mensaje.="Ok Precio correcto ".$PRECIO."<br/>" ;
                    }
                else{
                       //$mensaje.="UPS Precio incorrecto ".$PRECIO."<br/>"; break;
                } 

            if($_POST['cantidad']){

                if(isset($_POST["cantidad"])){
                    $cantidad = $_POST["cantidad"];
        
                    $state = $conexion->prepare("select * from inventario where id='$_POST[id]' ");
		            $state->execute();
		            $inventario = $state->fetch();
                    $stock=$inventario["stock"];

              

                        if($cantidad<0){

                            $mensaje.="La cantidad debe ser un número positivo";

                            $_POST["sucursal"]= $_SESSION["suc"];


                            break;
                            
                        }
                        
                          
                        else if ($cantidad>$stock){

                            $mensaje.="El producto no tiene stock";

                            
                            $_POST["sucursal"]= $_SESSION["suc"];

                            break;

                        }
        
                            
                       
                        $_POST["sucursal"]= $_SESSION["suc"];
                          
                            $CANTIDAD=($_POST['cantidad']);
                    }
                
                  
                            
                                  //                          
        
           

                /*
<?php
        if(isset($_GET["m"])){
            $m = $_GET["m"];

            switch($m){
                case "1":
                    echo "EL producto no tiene stock";
                    break;
                case "2":
                    echo "La cantidad debe ser un número positivo";
                    break;
            }
        }
        ?>
                */

            }else{$mensaje.="Ups... Algo pasa con la cantidad"."<br/>"; break;}
            
            
            if(!isset($_SESSION['CARRITO'])){

                $producto=array(

                'ID'=>$ID,
                'NOMBRE'=>$NOMBRE,
                'CANTIDAD'=>$CANTIDAD,
                'PRECIO'=>$PRECIO,
                
                );

                $_SESSION['CARRITO'][0]=$producto;
                $mensaje="Producto agregado al carrito";

            } else{


                $idProductos=array_column($_SESSION['CARRITO'],"ID");

                if(in_array($ID,$idProductos)){

                    $mensaje="El producto ya esta en el carrito";

                }else{

                $NumeroProductos=count($_SESSION['CARRITO']);

                $producto=array(

                    'ID'=>$ID,
                    'NOMBRE'=>$NOMBRE,
                    'CANTIDAD'=>$CANTIDAD,
                    'PRECIO'=>$PRECIO,
                    
                    );

                $_SESSION['CARRITO'][$NumeroProductos]=$producto;
                $mensaje="Producto agregado al carrito";
            }
            }

            //$mensaje= print_r($_SESSION,true);
           

            break;

            case"Eliminar":
            
                if(is_numeric(  openssl_decrypt ($_POST['id'],COD,KEY))){
                    $ID= openssl_decrypt ($_POST['id'],COD,KEY); 
                   
                    foreach($_SESSION['CARRITO'] as $indice=>$producto){
                        if($producto['ID']==$ID){
                            unset($_SESSION['CARRITO'][$indice]);
                            $_SESSION['CARRITO']=array_values($_SESSION["CARRITO"]); 
                             
                            echo "<script> alert('Elemento Borrado') </script> ";
                        }

                    }

                    }
                    else{
                        $mensaje.="UPS ID incorrecto".$ID."<br/>"; break;
                    }
            
            
            
            
            break;
            }
    }



?>