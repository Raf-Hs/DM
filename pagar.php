<?php 
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'template/cabecera.php';

?>

    

<?php 

if($_POST){
    


    $total=0;
    $SID=session_id();
    //$Correo=$_POST['email'];

    foreach($_SESSION['CARRITO'] as $indice=>$producto){

        $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);

    }
        $sentencia=$pdo->prepare("INSERT INTO `venta` 
                            (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`,`id_clie` , `Total`, `status`) 
        VALUES (NULL,:ClaveTransaccion, '', NOW() , :id_clie,:Total, 'pendiente' );");



        $sentencia->bindParam(":id_clie",$_SESSION["IdCliente"]);
        $sentencia->bindParam(":ClaveTransaccion",$SID);
        //$sentencia->bindParam(":Correo",$Correo);
        $sentencia->bindParam(":Total",$total);
        $sentencia->execute();

        
        $idVenta=$pdo->lastInsertId();
        
        $_SESSION["venta"]=$idVenta;
		


        $sentenciaSQL= $pdo->prepare("UPDATE venta SET `id_fac`= $idVenta WHERE ID=$idVenta;");

        $factura =  $sentenciaSQL->fetch();
       
        $sentenciaSQL->execute();

        $fecha = date("Y-m-d");

        $sentenciaSQL= $pdo->prepare("UPDATE factura SET fecha = $fecha WHERE ID=$idVenta;");
       
        $sentenciaSQL->execute();


    
        foreach($_SESSION['CARRITO'] as $indice=>$producto){ 


		
       
        $sta = $conexion->prepare("select * from inventario where id_suc='$_SESSION[sucursal]' and id_pro='$producto[ID]' ");
		$sta->execute();
		$inventario = $sta->fetch();

		$Idinventario=$inventario["id"];




            $sentencia=$pdo->prepare("INSERT INTO 
            `det_vta` (`ID`, `IDVENTA`, `IDINVENTARIO`, `PRECIOUNITARIO`, `CANTIDAD`) 
            VALUES (NULL,:IDVENTA, :IDINVENTARIO ,:PRECIOUNITARIO,:CANTIDAD);");





            $sentencia->bindParam(":IDVENTA",$idVenta);
            $sentencia->bindParam(":IDINVENTARIO",$Idinventario);
            $sentencia->bindParam(":PRECIOUNITARIO",$producto['PRECIO']);
            $sentencia->bindParam(":CANTIDAD",$producto['CANTIDAD']);
            $sentencia->execute();

    
        }

        
   // echo "<h3>".$total."</h3>";
}
$total=50;
?>



<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<style>
    
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }
    
    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 250px;
            display: inline-block;
        }
    }
    
</style>

<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso Final !</h1>
    <hr class="my-4">
    <p class="lead"> Estas a punto de pagar con paypal la cantidad de: 
        <h4>$<?php echo number_format($total,2); ?></h4>
        <div id="paypal-button-container"></div>
    </p>
        <p>Los productos podrán ser descargados una vez que se procese el pago<br/>
        <strong>(Para aclaraciones : Deadmanstales@gmail.com)</strong>
        </p>
</div>

<script>
    paypal.Button.render({
        env: 'sandbox', // sandbox | production
        style: {
            label: 'checkout',  // checkout | credit | pay | buynow | generic
            size:  'responsive', // small | medium | large | responsive
            shape: 'pill',   // pill | rect
            color: 'gold'   // gold | blue | silver | black
        },

        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create

        client: {
            sandbox:    'AeQsMA3mpADQ2W3z5CRFK4DkhrSkQoBDfRXzwZDf-A42jSXX7DDtJCX29Tag-xNojcDfuoVaU-kZvd6v',
            production: 'AWj1U3wK7eRFvKZJaonh6COY08MnxVt-SMj3kn2cCg257hpWEs0aA9PNDP1fBK1_COigMz9nG_-RYqaW'
        },

        // Wait for the PayPal button to be clicked

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?php echo $total;?>', currency: 'MXN' }, 
                            description:"Compra de productos a Deadmans:$<?php echo number_format($total,2);?>",
                            //custom:"<?php echo $SID;?>#<?php echo openssl_encrypt($idVenta,COD,KEY); ?>"
                        }
                    ]
                }
            });
        },

        // Wait for the payment to be authorized by the customer

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                console.log(data);
                window.location="verificador.php?paymentToken="+data.paymentToken+"&paymentID="+data.paymentID;
            });
        }
    
    }, '#paypal-button-container');

</script>


<?php include 'template/pie.php'; ?>