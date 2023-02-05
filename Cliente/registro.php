<?php session_start();

// Comprobamos si ya tiene una sesion
# Si ya tiene una sesion redirigimos al contenido, para que no pueda volver a registrar un usuario.
if (isset($_SESSION['usuario'])) {
	header('Location: index.php');
	die();
}

// Comprobamos si ya han sido enviado los datos
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Validamos que los datos hayan sido rellenados
	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
	$pass = $_POST['password'];

	$nombre=$_POST['nombre'];
    $apellidoP=$_POST['apellidoP'];
	$apellidoM=$_POST['apellidoM'];


	$telefono=$_POST['telefono'];
	$email=$_POST['email'];
    $ciudad=$_POST['ciudad'];
    $exterior=$_POST['exterior'];
	$interior=$_POST['interior'];

	$colonia=$_POST['colonia'];
	$calle=$_POST['calle'];
	$cp=$_POST['cp'];
	
    $rfc=$_POST['rfc'];
    $domf=$_POST['domf'];

	$errores = '';

	// Comprobamos que ninguno de los campos este vacio. 
	
		if (empty($usuario) or empty($pass) or empty($nombre) or empty($nombre) or empty($apellidoP) or empty($apellidoM) 
		or empty($telefono)  or empty($email)  or empty($ciudad)  or empty($exterior)  or empty($colonia) 
		or empty($calle)   or empty($cp)   or empty($rfc)   or empty($domf) 
		){
			$errores = '<li>Por favor rellena todos los datos correctamente</li>';
		} else {
	
			try {
				$conexion = new PDO('mysql:host=localhost;dbname=luran', 'root', '');
			} catch (PDOException $e) {
				echo "Error YYY:" . $e->getMessage();
			}
	
			$statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
			$statement->execute(array(':usuario' => $usuario));
	
			$resultado = $statement->fetch();
	
			if ($resultado != false) {
				$errores .= '<li>El nombre de usuario ya existe</li>';
			}
	
			
		}


		// Comprobamos que el usuario no exista ya.
	


	// Comprobamos si hay errores, sino entonces agregamos el usuario y redirigimos.
	if ($errores == '') {
		$query="INSERT INTO usuarios (id,usuario,contrasenia,tipo,activo)VALUES (null, '$usuario', '$pass', 2,1)";
		$resultado= $conexion->query($query);
		
	

			if($resultado){

                $query = "UPDATE cliente SET nombre='$nombre',apellidoM='$apellidoM',apellidoP='$apellidoP',telefono='$telefono',mail='$email',
                ciudad='$ciudad',exterior='$exterior',interior='$interior',colonia='$colonia',calle='$calle',
                    cp='$cp',rfc='$rfc',domf='$domf' WHERE id_usu=(SELECT id FROM usuarios WHERE usuario LIKE '$usuario')";
                $resultado2=$conexion->query($query);
                if($resultado2){
                    header('Location: login-usuario.php');
                }

			}





		// Despues de registrar al usuario redirigimos para que inicie sesion.
		header('Location: login.php');
	}


}

?>
























<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../css/estilos.css">
	<title>Registro</title>
</head>



<body>
	<div class="contenedor">
		<h1 class="titulo">Regístro</h1>
		
		<hr class="border">

		<form class="formulario" name="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input  required class="usuario" type="text" name="usuario" placeholder="Usuario">
			</div>

			<div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input  required  class="nombre" type="text" name="nombre" placeholder="Nombre">
			</div>
                        
          

        
                  
            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input  required class="apellidoP" type="text" name="apellidoP" placeholder="Apellido Paterno">
			</div>

            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input required class="apellidoM" type="text" name="apellidoM" placeholder="Apellido Materno">
			</div>
                

            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input required  class="telefono" type="number" name="telefono" placeholder="Telefono">
			</div>
                
            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input required  class="email" type="email" name="email" placeholder="Email">
			</div>
                
			
            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input required  class="ciudad" type="text" name="ciudad" placeholder="Ciudad">
			</div>
                
            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input required  class="exterior" type="number" name="exterior" placeholder="Exterior">
			</div>
                
            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input required class="interior" type="number" name="interior" placeholder="Interior" >
			</div>
                
            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input required  class="colonia" type="text" name="colonia" placeholder="Colonia">
			</div>

            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input required  class="calle" type="text" name="calle" placeholder="Calle">
			</div>

            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input  required class="cp" type="number" name="cp" placeholder="Cp">
			</div>

            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input required  class="rfc" type="text" name="rfc" placeholder="RFC">
			</div>

            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input  required class="domf" type="text" name="domf" placeholder="Domf">
			</div>


                <div>
				<i class="icono izquierda fa fa-lock"></i><input required  class="password" type="password" name="password" placeholder="Contraseña">
				<i class="submit-btn fa fa-arrow-right" onclick="login.submit()"></i>
			</div>
			



			



			<!-- Comprobamos si la variable errores esta seteada, si es asi mostramos los errores -->
			<?php if(!empty($errores)): ?>
				<div class="error">
					<ul>
						<?php echo $errores; ?>
					</ul>
				</div>
			<?php endif; ?>
		</form>

		<p >
			
			<a href="login.php">Iniciar Sesión</a>
		</p>

	</div>
</body>
</html>