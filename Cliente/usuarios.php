<?php include("template/cabecera.php"); 
        include("../global/config.php");
        include("../global/conexion.php");
        session_start();
?>






<?php 

$txtIDU=(isset($_POST['txtIDU']))?$_POST['txtIDU']:"";
$txtUsuario=(isset($_POST['txtUsuario']))?$_POST['txtUsuario']:"";
$txtContrasenia=(isset($_POST['txtContrasenia']))?$_POST['txtContrasenia']:"";
$txtActivo=(isset($_POST['txtActivo']))?$_POST['txtActivo']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



switch($accion){
      

        case "Modificar": 

            $sentenciaSQL= $pdo->prepare("UPDATE usuarios SET usuario=:usuario  WHERE id=:id");
            $sentenciaSQL->bindParam(':usuario',$txtUsuario);
            $sentenciaSQL->bindParam(':id',$txtIDU);
            $sentenciaSQL->execute();

            $sentenciaSQL= $pdo->prepare("UPDATE usuarios SET contrasenia=:contrasenia  WHERE id=:id");
            $sentenciaSQL->bindParam(':contrasenia',$txtContrasenia);
            $sentenciaSQL->bindParam(':id',$txtIDU);
            $sentenciaSQL->execute();
            
            $sentenciaSQL= $pdo->prepare("UPDATE usuarios SET activo=:activo  WHERE id=:id");
            $sentenciaSQL->bindParam(':activo',$txtActivo);
            $sentenciaSQL->bindParam(':id',$txtIDU);
            $sentenciaSQL->execute();

          
            

            
           
        
            header("Location:usuarios.php");
            break; 

        case "Cancelar": 
             header("Location:usuarios.php");
            break; 

        case "Seleccionar": 
           
            $sentenciaSQL= $pdo->prepare("SELECT * FROM usuarios WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtIDU);
            $sentenciaSQL->execute();
            $usuario=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            
            $txtUsuario=$usuario['usuario'];
            $txtContrasenia=$usuario['contrasenia'];
            $txtTipo=$usuario['tipo'];
            $txtActivo=$usuario['activo'];
            
            
                
               break;

        case "Borrar": 

            //Generar Baja logica

     
            $sentenciaSQL= $pdo->prepare("UPDATE usuarios SET `activo`= 0 WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            

                header("Location:usuarios.php");
               break;
}

$sentenciaSQL= $pdo->prepare("SELECT * FROM usuarios");
$sentenciaSQL->execute();
$ListaUsuarios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>


<div class="col-md-3">
    
    <div class="card">
        <div class="card-header">
            Datos de los usuarios
        </div>

        <div class="card-body">
           
        <form method="POST" enctype="multipart/form-data" >

    <div class = "form-group">
    <label for="txtIDU">ID:</label>
    <input type="text" required readonly class="form-control" value="<?php echo $txtIDU; ?>" name="txtIDU" id="txtIDU" placeholder="ID">
    </div>

    <div class = "form-group">
    <label for="txtUsuario">Usuario:</label>
    <input type="text" required class="form-control" value="<?php echo $txtUsuario; ?>" name="txtUsuario" id="txtUsuario" placeholder="Nombre del usuario">
    </div>

    <div class = "form-group">
    <label for="txtContrasenia">Contrasenia:</label>
    <input type="text" required class="form-control" value="<?php echo $txtContrasenia; ?>" name="txtContrasenia" id="txtContrasenia" placeholder="Contraseña">
    </div>

    <div class = "form-group">
    <label for="txtActivo">Activo:</label>
    <input type="text" required class="form-control" value="<?php echo $txtActivo; ?>" name="txtActivo" id="txtActivo" placeholder="Activo">
    </div>
  

   


        <div class="btn-group" role="group" aria-label="">
      
            <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?>  value="Modificar"class="btn btn-warning">Modificar</button>
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
                <th>Contraseña</th>
                <th>Tipo</th>
                <th>Activo</th>
                


                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php  foreach($ListaUsuarios as $usuario) { ?>
            <tr>


                    

            
                <td><?php echo $usuario['id']; ?></td>
                <td><?php echo $usuario['usuario']; ?></td>
                <td> <?php echo $usuario['contrasenia']; ?></td>
                <td> <?php echo $usuario['tipo']; ?></td>
                <td><?php echo $usuario['activo']; ?></td>
                

                <td>

                
                <form method="post">

                    <input type="hidden" name="txtIDU" id="txtIDU" value="<?php echo $usuario['id']; ?>" />

                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" <?php echo ($usuario["id"]<4)?"disabled":""; ?>/>

                   
                
                
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