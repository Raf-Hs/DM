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


	$errores = '';

	// Comprobamos que ninguno de los campos este vacio. 
	
		if (empty($usuario) or empty($pass) or empty($nombre) or empty($nombre) or empty($apellidoP) or empty($apellidoM) ) 
		{
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

		// Despues de registrar al usuario redirigimos para que inicie sesion.
		header('Location: login.php');
	}


}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="shortcut icon" href="img/Botella.ico">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    

</head>



<body>
	<div class="d-flex flex-column align-items-center mt-2">
		<h1 class="titulo">Regístro</h1>
		
		
		


		<form class="formulario" name="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input  required class="usuario" type="text" name="usuario" placeholder="Usuario">
			</div>


			
			<div class="form-group">
				<input  required  class="nombre" type="text" name="nombre" placeholder="Nombre">
				<input  required class="apellidoP" type="text" name="apellidoP" placeholder="Apellido Paterno">
				</i><input required class="apellidoM" type="text" name="apellidoM" placeholder="Apellido Materno">
			</div>
                        
         
           
                
            <div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input required  class="email" type="email" name="email" placeholder="Email">
			</div>
                
			


                <div>
				<i class="icono izquierda fa fa-lock"></i><input required  class="password" type="password" name="password" placeholder="Contraseña">
				
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