<?php include("template/cabecera.php"); 
        include("../global/config.php");
        include("../global/conexion.php");
        session_start();
?>






<?php 

$txtIDC=(isset($_POST['txtIDC']))?$_POST['txtIDC']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellidoM=(isset($_POST['txtApellidoM']))?$_POST['txtApellidoM']:"";
$txtApellidoP=(isset($_POST['txtApellidoP']))?$_POST['txtApellidoP']:"";
$txtTelefono=(isset($_POST['txtTelefono']))?$_POST['txtTelefono']:"";
$txtMail=(isset($_POST['txtMail']))?$_POST['txtMail']:"";
$txtCiudad=(isset($_POST['txtCiudad']))?$_POST['txtCiudad']:"";
$txtExterior=(isset($_POST['txtExterior']))?$_POST['txtExterior']:"";
$txtInterior=(isset($_POST['txtInterior']))?$_POST['txtInterior']:"";
$txtColonia=(isset($_POST['txtColonia']))?$_POST['txtColonia']:"";
$txtCalle=(isset($_POST['txtCalle']))?$_POST['txtCalle']:"";
$txtCp=(isset($_POST['txtCp']))?$_POST['txtCp']:"";
$txtRfc=(isset($_POST['txtRfc']))?$_POST['txtRfc']:"";
$txtDomf=(isset($_POST['txtDomf']))?$_POST['txtDomf']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



switch($accion){
      

        case "Modificar": 

            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET nombre=:nombre  WHERE id=:id");
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();

         
            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET apellidoP=:apellidoP  WHERE id=:id");
            $sentenciaSQL->bindParam(':apellidoP',$txtApellidoP);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();

            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET apellidoM=:apellidoM  WHERE id=:id");
            $sentenciaSQL->bindParam(':apellidoM',$txtApellidoM);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();
            
            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET telefono=:telefono  WHERE id=:id");
            $sentenciaSQL->bindParam(':telefono',$txtTelefono);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();
            
            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET mail=:mail  WHERE id=:id");
            $sentenciaSQL->bindParam(':mail',$txtMail);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();
           
            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET ciudad=:ciudad  WHERE id=:id");
            $sentenciaSQL->bindParam(':ciudad',$txtCiudad);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();

            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET exterior=:exterior  WHERE id=:id");
            $sentenciaSQL->bindParam(':exterior',$txtExterior);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();
        
          

            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET interior=:interior  WHERE id=:id");
            $sentenciaSQL->bindParam(':interior',$txtInterior);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();

            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET colonia=:colonia  WHERE id=:id");
            $sentenciaSQL->bindParam(':colonia',$txtColonia);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();

            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET calle=:calle  WHERE id=:id");
            $sentenciaSQL->bindParam(':calle',$txtCalle);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();


            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET cp=:cp  WHERE id=:id");
            $sentenciaSQL->bindParam(':cp',$txtCp);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();

            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET rfc=:rfc  WHERE id=:id");
            $sentenciaSQL->bindParam(':rfc',$txtRfc);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();

            $sentenciaSQL= $pdo->prepare("UPDATE cliente SET domf=:domf  WHERE id=:id");
            $sentenciaSQL->bindParam(':domf',$txtDomf);
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();

            header("Location:clientes.php");
            break; 

        case "Cancelar": 
             header("Location:clientes.php");
            break; 

        case "Seleccionar": 
           
            $sentenciaSQL= $pdo->prepare("SELECT * FROM cliente WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtIDC);
            $sentenciaSQL->execute();
            $cliente=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtIDC= $cliente['id'];
            $txtNombre=$cliente['nombre'];
            $txtApellidoM =$cliente['apellidoM']; 
            $txtApellidoP= $cliente['apellidoP']; 
            $txtTelefono=$cliente['telefono']; 
            $txtMail=$cliente['mail']; 
            $txtCiudad= $cliente['ciudad']; 
            $txtExterior= $cliente['exterior']; 
            $txtInterior=$cliente['interior']; 
            $txtColonia= $cliente['colonia']; 
            $txtCalle= $cliente['calle']; 
            $txtCp= $cliente['cp'];
            $txtRfc=$cliente['rfc']; 
            $txtDomf=$cliente['domf'];
            
              
            
            
                
               break;

        
}

$sentenciaSQL= $pdo->prepare("SELECT * FROM cliente");
$sentenciaSQL->execute();
$ListaClientes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>


<div class="col-md-3">
    
    <div class="card">
        <div class="card-header">
            Datos de los clientes
        </div>

        <div class="card-body">
           
        <form method="POST" enctype="multipart/form-data" >

    <div class = "form-group">
    <label for="txtIDC">ID:</label>
    <input type="text" required readonly class="form-control" value="<?php echo $txtIDC; ?>" name="txtIDC" id="txtIDC" placeholder="ID">
    </div>

    <div class = "form-group">
    <label for="txtNombre">Nombre:</label>
    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del cliente">
    </div>

    <div class = "form-group">
    <label for="txtApellidoP">Apellido Paterno: </label>
    <input type="text" required class="form-control" value="<?php echo $txtApellidoP; ?>" name="txtApellidoP" id="txtApellidoP" placeholder="Apellido Paterno">
    </div>

    
    <div class = "form-group">
    <label for="txtApellidoM">Apellido Materno: </label>
    <input type="text" required class="form-control" value="<?php echo $txtApellidoM; ?>" name="txtApellidoM" id="txtApellidoM" placeholder="Apellido Materno">
    </div>


    <div class = "form-group">
    <label for="txtTelefono">Telefono: </label>
    <input type="text" required class="form-control" value="<?php echo $txtTelefono; ?>" name="txtTelefono" id="txtTelefono" placeholder="Telefono">
    </div>

    <div class = "form-group">
    <label for="txtMail">Mail: </label>
    <input type="text" required class="form-control" value="<?php echo $txtMail; ?>" name="txtMail" id="txtMail" placeholder="Mail">
    </div>

    <div class = "form-group">
    <label for="txtCiudad">Ciudad: </label>
    <input type="text" required class="form-control" value="<?php echo $txtCiudad; ?>" name="txtCiudad" id="txtCiudad" placeholder="Ciudad">
    </div>

        </div>
</div>

</div>
<div class="col-md-3">
<div class="card-body">


   <div class="card">
        <div class="card-header">
            Datos de los clientes
        </div>


    <div class = "form-group">
    <label for="txtExterior">Exterior: </label>
    <input type="text" required class="form-control" value="<?php echo $txtExterior; ?>" name="txtExterior" id="txtExterior" placeholder="# Exterior">
    </div>

    <div class = "form-group">
    <label for="txtExterior">Interior: </label>
    <input type="text" required class="form-control" value="<?php echo $txtExterior; ?>" name="txtExterior" id="txtExterior" placeholder="# Exterior">
    </div>

    <div class = "form-group">
    <label for="txtColonia">Colonia: </label>
    <input type="text" required class="form-control" value="<?php echo $txtColonia; ?>" name="txtColonia" id="txtColonia" placeholder="Colonia">
    </div>

    <div class = "form-group">
    <label for="txtCalle">Calle: </label>
    <input type="text" required class="form-control" value="<?php echo $txtCalle; ?>" name="txtCalle" id="txtCalle" placeholder="Calle">
    </div>
    
    <div class = "form-group">
    <label for="txtCp">Cp: </label>
    <input type="text" required class="form-control" value="<?php echo $txtCp; ?>" name="txtCp" id="txtCp" placeholder="Cp">
    </div>

    <div class = "form-group">
    <label for="txtRfc">Rfc: </label>
    <input type="text" required class="form-control" value="<?php echo $txtRfc; ?>" name="txtRfc" id="txtRfc" placeholder="RFC">
    </div>

    <div class = "form-group">
    <label for="txtDomf">Domicilio Fiscal: </label>
    <input type="text" required class="form-control" value="<?php echo $txtRfc; ?>" name="txtDomf" id="txtDomf" placeholder="Domicilio Fiscal">
    </div>

</div>
</div>
<div class="btn-group" role="group" aria-label="">
      
      <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?>  value="Modificar"class="btn btn-warning">Modificar</button>
      <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?>  value="Cancelar" class="btn btn-info">Cancelar</button>
  </div>
</div>









     


    </form>

        </div>

       
    </div>


    
    
    

</div>
<div class="col-md-12">


    <table class="table table-bordered" id="tabla" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Telefono</th>
                <th>Mail</th>
                <th>Ciudad</th>
                <th>Exterior</th>
                <th>Interior</th>
                <th>Colonia</th>
                <th>Calle</th>
                <th>Cp</th>
                <th>RFC</th>
                <th>Domicilio Fiscal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php  foreach($ListaClientes as $cliente) { ?>
            <tr>


                    

            
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo$cliente['nombre']; ?></td>
                    <td><?php echo $cliente['apellidoP']; ?></td>
                    <td><?php echo $cliente['apellidoM']; ?></td>
                    <td><?php echo $cliente['telefono']; ?></td>
                    <td><?php echo $cliente['mail']; ?></td>
                    <td><?php echo$cliente['ciudad']; ?></td>
                    <td> <?php echo $cliente['exterior']; ?></td>
                    <td> <?php echo $cliente['interior']; ?></td>
                    <td><?php echo $cliente['colonia']; ?></td>
                    <td> <?php echo $cliente['calle']; ?></td>
                    <td> <?php echo $cliente['cp']; ?></td>
                    <td><?php echo $cliente['rfc']; ?></td>
                    <td><?php echo $cliente['domf']; ?></td>

                <td>
                <form method="post">

                    <input type="hidden" name="txtIDC" id="txtIDC" value="<?php  echo $cliente['id']; ?>" />

                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>

                   
                
                
                </form>

                
                </td>

            </tr>
           <?php } ?>
        </tbody>
    </table>


</div>

<script>

    var tabla= document.querySelector("#tabla");

    var dataTable = new DataTable(tabla,{
            perPage:7,
            perPageSelect:[3,6,9,12]

    });

</script>

<?php include("template/pie.php"); ?>