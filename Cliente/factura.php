
<?php
include '../global/config.php';
include '../global/conexion.php';




ob_start();

session_start();
//echo $_SESSION['IdCliente'];

$state1 = $conexion->prepare("select * from cliente where id= $_SESSION[IdCliente]; ; ");
$state1->execute();
$cliente = $state1->fetch();

$Idcliente=$cliente["id"];
$nombre=$cliente["nombre"];
$apellidoM=$cliente["apellidoM"];
$apellidoP=$cliente["apellidoP"];
$telefono=$cliente["telefono"];
$mail=$cliente["mail"];
$ciudad=$cliente["ciudad"];
$exterior=$cliente["exterior"];
$interior=$cliente["interior"];
$colonia=$cliente["colonia"];
$calle=$cliente["calle"];
$cp=$cliente["cp"];
$rfc=$cliente["rfc"];
$domf=$cliente["domf"];









$factura1 = $conexion->prepare("select * from factura where ID= $_SESSION[venta]; ");
$factura1->execute();
$factura = $factura1->fetch();

$Idfactura= $factura["id"];

$sta = $conexion->prepare("select * from det_vta where IDVENTA= $_SESSION[venta]; ");
$sta->execute();
$compra = $sta->fetch();


$Ic=$compra["ID"];
$Iv=$compra["IDVENTA"];
$Iinv=$compra["IDINVENTARIO"];

$Preciou= $compra["PRECIOUNITARIO"];
$Cantidad= $compra["CANTIDAD"];





$ta1 = $conexion->prepare("select * from inventario where ID= $Iinv");
$ta1->execute();
$inventario = $ta1->fetch();

$Idproducto= $inventario["id_pro"];



$ta = $conexion->prepare("select * from producto where ID= $Idproducto");
$ta->execute();
$productos = $ta->fetch();

$Nproducto= $productos["Nombre"];



	$cliente1 = $nombre." ".$apellidoP." ". $apellidoM;
	$direccion= $ciudad." ".$colonia." ". $calle ." ". $exterior ." ". $interior;
	$remitente = "Luran Company";
	$web = "https://luran.com";
	$mensajePie = "Gracias por su compra";
	$numero = 1;
	$descuento = 0;
	$porcentajeImpuestos = 16;
	
	$productos = [
	[

		
	"precio" =>$Preciou,
	"descripcion" => $Nproducto,
	"cantidad" => $Cantidad,
	]

	];
	$fecha = date("Y-m-d");

    ?>
    <!DOCTYPE html>
	<html lang="es">
	<head>
	<link rel="stylesheet" href="./bs3.min.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Factura</title>
	</head>
    <div class="row">
	<div class="col-xs-10 ">
	<h1>Factura</h1>
	</div>
	<div class="col-xs-2">
	<!--<img class="img img-responsive" src="../img/L.png" alt="Logotipo">-->
	</div>
	</div>
	<hr>
	<div class="row">
	<div class="col-xs-5">
	<h1 class="h6"><?php echo $remitente ?></h1>
	<h1 class="h6"><?php echo $web ?></h1>
	</div>
	<div class="col-xs-2 text-center">
	<strong>Fecha</strong>
	<br>
	<?php echo $fecha ?>
	<br>
	<strong>Compra</strong>
	<br>
	<?php echo $Ic ?>
	<br>
	<strong>Factura No.</strong>
	<br>
	<?php echo $Idfactura ?>
	</div>
	<strong>Nombre</strong>
	<br>
	<?php echo $cliente1 ?>
	<br>
	<strong>Dirección</strong>
	<br>
	<?php echo $direccion ?>
	<br>
	<strong>Teléfono</strong>
	<br>
	<?php echo $telefono ?>
	<br>
	<strong>Mail</strong>
	<br>
	<?php  echo $mail ?>
	<br>
	<strong>RFC</strong>
	<br>
	<?php echo $rfc ?>
	<br>
	<strong>Domicilio Fiscal</strong>
	<br>
	<?php echo $domf ?>
	<br>
	</div>
    <div class="row text-center" style="margin-bottom: 2rem;">
	<div class="col-xs-6">
	<h1 class="h2">Cliente</h1>
	<strong><?php echo $cliente1 ?></strong>
	</div>
	
	

	</div>
    <div class="row">
	<div class="col-xs-12">
	<table class="table table-condensed table-bordered table-striped">
	<thead>
	<tr>
	<th>Descripción</th>
	<th>Cantidad</th>
	<th>Precio unitario</th>
	<th>Total</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$subtotal = 0;
	
	
	$totalProducto =$Cantidad= $Cantidad * $Preciou;
	$subtotal += $totalProducto;
	?>
	<tr>
	<td><?php echo $Nproducto ?></td>
	<td><?php echo number_format($Cantidad, 2) ?></td>
	<td>$<?php echo number_format($Preciou, 2) ?></td>
	<td>$<?php echo number_format($totalProducto, 2) ?></td>
	</tr>
	<?php 
	$subtotalConDescuento = $subtotal - $descuento;
	$impuestos = $subtotalConDescuento * ($porcentajeImpuestos / 100);
	$total = $subtotalConDescuento ;
	?>
	</tbody>
	<tfoot>
	<tr>
	<td colspan="3" class="text-right">Subtotal</td>
	<td>$<?php echo number_format($subtotal, 2) ?></td>
	</tr>
	<tr>
	<td colspan="3" class="text-right">Descuento</td>
	<td>$<?php echo number_format($descuento, 2) ?></td>
	</tr>
	<tr>
	<td colspan="3" class="text-right">Subtotal con descuento</td>
	<td>$<?php echo number_format($subtotalConDescuento, 2) ?></td>
	</tr>
	<tr>
	<td colspan="3" class="text-right">Impuestos</td>
	<td>$<?php echo number_format($impuestos, 2) ?></td>
	</tr>
	<tr>
	<td colspan="3" class="text-right">
	<h4>Total</h4></td>
	<td>
	<h4>$<?php echo number_format($total, 2) ?></h4>
	</td>
	</tr>
	</tfoot>
	</table>
	</div>
	</div>
    <div class="row">
	<div class="col-xs-12 text-center">
	<p class="h5"><?php echo $mensajePie ?></p>
	</div>
	</div>
	

	<?php 
	$html=ob_get_clean();

	require_once 'dompdf/autoload.inc.php';
	
	use Dompdf\Dompdf;
	$dompdf = new DOMPDF();

	
		
	
	$options = $dompdf->getOptions(); 
	$options->set(array('isRemoteEnabled' => true));
	$dompdf->setOptions($options);
	
	$dompdf->loadHtml($html);
	
	$dompdf->setPaper('letter');
	//$dompdf->setPaper('A4', 'landscape');
	
	$dompdf->render();
	
	$dompdf->stream("archivo_.pdf", array("Attachment" => false));
	
	?>