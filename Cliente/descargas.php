<?php
    include '../global/config.php';
    include '../global/conexion.php';
 
    session_start();
    echo 	$_SESSION["IdCliente"];
    //Update
    include_once "./vendor/autoload.php";
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    ob_start();
    include "./factura.php";
    $html = ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->render();
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=factura.pdf");
    echo $dompdf->output();

?>

<?php 



    if($_POST){



        





        $IDVenta= openssl_decrypt( $_POST['IDVENTA'],COD,KEY);
        $IDPRODUCTO= openssl_decrypt($_POST['IDPRODUCTO'],COD,KEY);


        
        print_r("ID Venta: ".$IDVenta);
        print_r($IDPRODUCTO);

        $sentencia=$pdo->prepare("SELECT * 
        FROM carrito
        WHERE id_vta = :id_vta
        and id_pro=:id_pro
        and descargado<1" );
    
        $sentencia->bindParam(":id_vta",$IDVenta);
        $sentencia->bindParam(":id_pro",$IDPRODUCTO);
        $sentencia->execute();
    
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

        print_r($listaProductos);

        if($sentencia->rowCount()>0){

            echo"Archivo en descarga...";

            $nombreArchivo="archivos/".$listaProductos[0]['id_pro'].".pdf";

            $nuevoNombreArchivo=$_POST['IDVENTA'].$_POST['IDPRODUCTO'].".pdf";

            echo $nuevoNombreArchivo;


            header("Content-Transfer.Encoding: binary");
            header("Content-type: application/force-download");
            header("Content-Disposition: attachment; filename=\"$nuevoNombreArchivo\" ");
            readfile("$nombreArchivo");


            
            $sentencia=$pdo->prepare
            ("UPDATE `carrito` 
            SET `descargado` = descargado+1
            WHERE id_vta=:id_vta and id_pro=:id_pro; ");
    
            $sentencia->bindParam(":id_vta",$IDVenta);
            $sentencia->bindParam(":id_pro",$IDPRODUCTO);
            $sentencia->execute();

            

        }else{
            include'templates/cabecera.php';
            echo "<br><br><br><br><h2>Tus descargas se agotaron</h2>";
            include 'templates/pie.php';
        }

     
       




    }



?>













