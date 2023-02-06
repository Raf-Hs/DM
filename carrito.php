<?php



$mensaje="";

if(isset($_POST['btnAccion'])){

switch($_POST['btnAccion']){

    case 'Agregar':
            if($_POST['id']){
            $ID= $_POST['id']; 
            $mensaje.="Ok ID correcto".$ID."<br/>" ;
            }
            else{
               // $mensaje.="UPS ID incorrecto".$ID."<br/>"; break;
            }
           
            if($_POST['nombre']){
                $NOMBRE= $_POST['nombre']; 
                //$mensaje.="Ok Nombre correcto ".$NOMBRE."<br/>" ;
                }
                else{
                    $mensaje.="UPS Nombre incorrecto ".$NOMBRE."<br/>"; break;
                } 
                
            if($_POST['precio']){
                $PRECIO= $_POST['precio']; 
                $mensaje.="Ok Precio correcto ".$PRECIO."<br/>" ;
                    }
                else{
                       //$mensaje.="UPS Precio incorrecto ".$PRECIO."<br/>"; break;
                } 

            
            if(!isset($_SESSION['CARRITO'])){

                $producto=array(

                'ID'=>$ID,
                'NOMBRE'=>$NOMBRE,
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