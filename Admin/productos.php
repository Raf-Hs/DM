<?php include("template /cabecera.php"); 
        include("../global/config.php");
        include("../global/conexion.php");
        session_start();
?>


<?php 



$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";

$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$txtStock=(isset($_POST['txtStock']))?$_POST['txtStock']:"";
$txtActivo=(isset($_POST['txtActivo']))?$_POST['txtActivo']:"";
$txtSucursal=(isset($_POST['txtSucursal']))?$_POST['txtSucursal']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";





switch ($_SESSION["id"]) {
    case '1':
        

switch($accion){
        
    case "Agregar":
    
        //Unirlas
        
        $sentenciaSQL= $pdo->prepare("INSERT INTO producto (id,nombre,precio,descripcion,imagen,activo ) 
        VALUES (null,:nombre,:precio,:descripcion,:imagen,:activo);");

        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':precio',$txtPrecio);
        $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
        $sentenciaSQL->bindParam(':imagen',$txtImagen);
        $sentenciaSQL->bindParam(':activo',$txtActivo);
        $sentenciaSQL->execute();

        /*
        $sentenciaSQL= $pdo->prepare("INSERT INTO inventario (id,id_suc,id_pro,stock ) 
        VALUES (null, null ,:id,:stock) ");
        $sentenciaSQL->bindParam(':id',$txtID); 
        $sentenciaSQL->bindParam(':stock',$txtStock);   
        $sentenciaSQL->execute();
*/
  

        $sentenciaSQL= $pdo->prepare("UPDATE inventario SET `id_pro`=:id,`stock`=:stock WHERE id_pro=null;");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->bindParam(':stock',$txtStock);  
        

    
        

      
       
        $sentenciaSQL->execute();
    

   

    header("Location:productos.php");
    break; 

  

case "Modificar": 

    $sentenciaSQL= $pdo->prepare("UPDATE producto SET nombre=:nombre  WHERE id=:id");
    $sentenciaSQL->bindParam(':nombre',$txtNombre);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();

    $sentenciaSQL= $pdo->prepare("UPDATE producto SET precio=:precio  WHERE id=:id");
    $sentenciaSQL->bindParam(':precio',$txtPrecio);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    
    $sentenciaSQL= $pdo->prepare("UPDATE producto SET descripcion=:descripcion  WHERE id=:id");
    $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();

    $sentenciaSQL= $pdo->prepare("UPDATE producto SET activo=:activo  WHERE id=:id");
    $sentenciaSQL->bindParam(':activo',$txtActivo);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    
    $sentenciaSQL= $pdo->prepare("UPDATE inventario SET stock=:stock  WHERE id_pro=:id and id_suc=1");
    $sentenciaSQL->bindParam(':stock',$txtStock);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    

        $sentenciaSQL= $pdo->prepare("UPDATE inventario SET `id_suc`= 1 WHERE id_pro=:id and id_suc=0");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        



    
    
    if($txtImagen!=""){

        $fecha= new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

        $sentenciaSQL= $pdo->prepare("SELECT imagen FROM producto WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
        if( isset($producto["imagen"]) &&($producto["imagen"]!="imagen.jpg") ){

            if(file_exists("../../img/".$producto["imagen"])){

                unlink("../../img/".$producto["imagen"]);
            }

        }

        

        $sentenciaSQL= $pdo->prepare("UPDATE producto SET imagen=:imagen WHERE id=:id");
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
    }
    header("Location:productos.php");
    break; 

case "Cancelar": 
     header("Location:productos.php");
    break; 

case "Seleccionar": 
   
    $sentenciaSQL= $pdo->prepare("SELECT * FROM producto WHERE producto.id=:id");
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
    $txtNombre=$producto['nombre'];
    $txtPrecio=$producto['precio'];
    $txtDescripcion=$producto['descripcion'];
    $txtStock=$producto['stock'];
    $txtImagen=$producto['imagen'];
    $txtActivo=$producto['activo'];
 
    
       break;

case "Borrar": 

    //Generar Baja logica

    $sentenciaSQL= $pdo->prepare("UPDATE producto SET activo=:activo  WHERE id=:id");
    $sentenciaSQL->bindParam(':activo',$txtActivo);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();

    

        header("Location:productos.php");
       break;
}

$sentenciaSQL= $pdo->prepare(
"SELECT 
inventario.stock,
producto.nombre, producto.id,precio,descripcion,imagen,activo  from inventario
inner join sucursal on (inventario.id_suc=sucursal.id)
inner join producto on (inventario.id_pro=producto.id)
where inventario.id_suc = 1 or inventario.id_suc = 0"); 
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        
        break;
     case '2':
        
        

switch($accion){
        
    case "Agregar":
    
      
        //Unirlas
        
        $sentenciaSQL= $pdo->prepare("INSERT INTO producto (id,nombre,precio,descripcion,imagen,activo ) 
        VALUES (null,:nombre,:precio,:descripcion,:imagen,:activo);");

        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':precio',$txtPrecio);
        $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
        $sentenciaSQL->bindParam(':imagen',$txtImagen);
        $sentenciaSQL->bindParam(':activo',$txtActivo);
        $sentenciaSQL->execute();

        /*
        $sentenciaSQL= $pdo->prepare("INSERT INTO inventario (id,id_suc,id_pro,stock ) 
        VALUES (null, null ,:id,:stock) ");
        $sentenciaSQL->bindParam(':id',$txtID); 
        $sentenciaSQL->bindParam(':stock',$txtStock);   
        $sentenciaSQL->execute();
*/
  

        $sentenciaSQL= $pdo->prepare("UPDATE inventario SET `id_pro`=:id,`stock`=:stock WHERE id_pro=null;");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->bindParam(':stock',$txtStock);  
        

    
        

      
       
        $sentenciaSQL->execute();
    

   

    header("Location:productos.php");
    break; 
  

case "Modificar": 

    $sentenciaSQL= $pdo->prepare("UPDATE producto SET nombre=:nombre  WHERE id=:id");
    $sentenciaSQL->bindParam(':nombre',$txtNombre);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();

    $sentenciaSQL= $pdo->prepare("UPDATE producto SET precio=:precio  WHERE id=:id");
    $sentenciaSQL->bindParam(':precio',$txtPrecio);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    
    $sentenciaSQL= $pdo->prepare("UPDATE producto SET descripcion=:descripcion  WHERE id=:id");
    $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();

    $sentenciaSQL= $pdo->prepare("UPDATE producto SET activo=:activo  WHERE id=:id");
    $sentenciaSQL->bindParam(':activo',$txtActivo);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    
    $sentenciaSQL= $pdo->prepare("UPDATE inventario SET stock=:stock  WHERE id_pro=:id and id_suc=2");
    $sentenciaSQL->bindParam(':stock',$txtStock);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    
   
    $sentenciaSQL= $pdo->prepare("UPDATE inventario SET `id_suc`= 2 WHERE id_pro=:id and id_suc=0");
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    
    if($txtImagen!=""){

        $fecha= new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

        $sentenciaSQL= $pdo->prepare("SELECT imagen FROM producto WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
        if( isset($producto["imagen"]) &&($producto["imagen"]!="imagen.jpg") ){

            if(file_exists("../../img/".$producto["imagen"])){

                unlink("../../img/".$producto["imagen"]);
            }

        }

        

        $sentenciaSQL= $pdo->prepare("UPDATE producto SET imagen=:imagen WHERE id=:id");
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
    }
    header("Location:productos.php");
    break; 

case "Cancelar": 
     header("Location:productos.php");
    break; 

case "Seleccionar": 
   
    $sentenciaSQL= $pdo->prepare("SELECT * FROM producto WHERE producto.id=:id");
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
    $txtNombre=$producto['nombre'];
    $txtPrecio=$producto['precio'];
    $txtDescripcion=$producto['descripcion'];
    $txtStock=$producto['stock'];
    $txtImagen=$producto['imagen'];
    $txtActivo=$producto['activo'];
 
        
       break;

case "Borrar": 

    //Generar Baja logica

    $sentenciaSQL= $pdo->prepare("UPDATE producto SET activo=:activo  WHERE id=:id");
    $sentenciaSQL->bindParam(':activo',$txtActivo);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();

    

        header("Location:productos.php");
       break;
}

$sentenciaSQL= $pdo->prepare(
"SELECT 
inventario.stock,
producto.nombre, producto.id,precio,descripcion,imagen,activo  from inventario
inner join sucursal on (inventario.id_suc=sucursal.id)
inner join producto on (inventario.id_pro=producto.id)
where inventario.id_suc = 2 or inventario.id_suc = 0"); 
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

     break;
    case '3':
       
        

switch($accion){
        
    case "Agregar":
    
        //Unirlas
        
            $sentenciaSQL= $pdo->prepare("INSERT INTO producto (id,nombre,precio,descripcion,imagen,activo ) 
            VALUES (null,:nombre,:precio,:descripcion,:imagen,:activo);");

            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':precio',$txtPrecio);
            $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
            $sentenciaSQL->bindParam(':imagen',$txtImagen);
            $sentenciaSQL->bindParam(':activo',$txtActivo);
            $sentenciaSQL->execute();

            /*
            $sentenciaSQL= $pdo->prepare("INSERT INTO inventario (id,id_suc,id_pro,stock ) 
            VALUES (null, null ,:id,:stock) ");
            $sentenciaSQL->bindParam(':id',$txtID); 
            $sentenciaSQL->bindParam(':stock',$txtStock);   
            $sentenciaSQL->execute();
*/
      

            $sentenciaSQL= $pdo->prepare("UPDATE inventario SET `id_pro`=:id,`stock`=:stock WHERE id_pro=null;");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->bindParam(':stock',$txtStock);  
            

        
            

          
           
            $sentenciaSQL->execute();
        

       

        header("Location:productos.php");
        break; 

  

case "Modificar": 

    $sentenciaSQL= $pdo->prepare("UPDATE producto SET nombre=:nombre  WHERE id=:id");
    $sentenciaSQL->bindParam(':nombre',$txtNombre);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();

    $sentenciaSQL= $pdo->prepare("UPDATE producto SET precio=:precio  WHERE id=:id");
    $sentenciaSQL->bindParam(':precio',$txtPrecio);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    
    $sentenciaSQL= $pdo->prepare("UPDATE producto SET descripcion=:descripcion  WHERE id=:id");
    $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();

    $sentenciaSQL= $pdo->prepare("UPDATE producto SET activo=:activo  WHERE id=:id");
    $sentenciaSQL->bindParam(':activo',$txtActivo);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    
    $sentenciaSQL= $pdo->prepare("UPDATE inventario SET stock=:stock  WHERE id_pro=:id and id_suc=3");
    $sentenciaSQL->bindParam(':stock',$txtStock);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
       
    $sentenciaSQL= $pdo->prepare("UPDATE inventario SET `id_suc`= 3 WHERE id_pro=:id and id_suc=0");
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();

    
    if($txtImagen!=""){

        $fecha= new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

        $sentenciaSQL= $pdo->prepare("SELECT imagen FROM producto WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
        if( isset($producto["imagen"]) &&($producto["imagen"]!="imagen.jpg") ){

            if(file_exists("../../img/".$producto["imagen"])){

                unlink("../../img/".$producto["imagen"]);
            }

        }

        

        $sentenciaSQL= $pdo->prepare("UPDATE producto SET imagen=:imagen WHERE id=:id");
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
    }
    header("Location:productos.php");
    break; 

case "Cancelar": 
     header("Location:productos.php");
    break; 

case "Seleccionar": 
   
    $sentenciaSQL= $pdo->prepare("SELECT * FROM producto WHERE producto.id=:id");
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
    $txtNombre=$producto['nombre'];
    $txtPrecio=$producto['precio'];
    $txtDescripcion=$producto['descripcion'];
    $txtStock=$producto['stock'];
    $txtImagen=$producto['imagen'];
    $txtActivo=$producto['activo'];
 
        
       break;

case "Borrar": 

    //Generar Baja logica

    $sentenciaSQL= $pdo->prepare("UPDATE producto SET activo=:activo  WHERE id=:id");
    $sentenciaSQL->bindParam(':activo',$txtActivo);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();

    

        header("Location:productos.php");
       break;
}

$sentenciaSQL= $pdo->prepare(
"SELECT 
inventario.stock,
producto.nombre, producto.id,precio,descripcion,imagen,activo  from inventario
inner join sucursal on (inventario.id_suc=sucursal.id)
inner join producto on (inventario.id_pro=producto.id)
where inventario.id_suc = 3 or inventario.id_suc = 0"); 
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

     break;
    default:
       
        break;
}













?>


<div class="col-md-3">
    
    <div class="card">
        <div class="card-header">
            Datos del alumno
        </div>

        <div class="card-body">
           
        <form method="POST" enctype="multipart/form-data" >

    <div class = "form-group">
    <label for="txtID">ID:</label>
    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
    </div>

    <div class = "form-group">
    <label for="txtNombre">Nombre:</label>
    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del producto">
    </div>

    <div class = "form-group">
    <label for="txtPrecio">Precio:</label>
    <input type="text" required class="form-control" value="<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Precio">
    </div>

    <div class = "form-group">
    <label for="txtDescripcion">Descripcion:</label>
    <input type="text" required class="form-control" value="<?php echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Descripcion">
    </div>

    <div class = "form-group">
    <label for="txtStock">Stock</label>
    <input type="text" class="form-control" value="<?php echo $txtStock; ?>" name="txtStock" id="txtStock" placeholder="Stock">
    </div>
  
    <div class = "form-group">
    <label for="txtActivo">Activo</label>
    <input type="text"  class="form-control" value="<?php echo $txtActivo; ?>" name="txtActivo" id="txtActivo" placeholder="Activo">
    </div>

    <div class = "form-group">
    <label for="txtNombre">Imagen:</label>

   <br/>

    <?php   if($txtImagen!=""){  ?>
        
        <img class="img-thumbnail rounded"  src="../../img/<?php echo $txtImagen;?>" width="50" alt="" srcset="">

                

    <?php   } ?>

    <input type="file" class="form-control"  name="txtImagen" id="txtImagen" placeholder="Nombre del producto">
    </div>


        <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
            <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar"class="btn btn-warning">Modificar</button>
            <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?>  value="Cancelar" class="btn btn-info">Cancelar</button>
        </div>


    </form>

        </div>

       
    </div>


    
    
    

</div>
<div class="col-md-9">


    <table class="table table-bordered" id="tabla" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Stock</th>
                <th>Activo</th>


                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php  foreach($listaProductos as $producto) { ?>
            <tr>
                <td><?php echo $producto['id']; ?></td>
                <td><?php echo $producto['nombre']; ?></td>
                <td>
                
                <img class="img-thumbnail rounded" src="../../img/<?php echo $producto['imagen']; ?>" width="50" alt="" srcset="">
                
                </td>

                <td> $ <?php echo $producto['precio']; ?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td><?php echo $producto['stock']; ?></td>
                
                <td><?php echo $producto['activo']; ?></td>

                <td>

                
                <form method="post">

                    <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['id']; ?>" />

                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>

                    <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                
                
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