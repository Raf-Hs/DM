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
	$pass2 = $_POST['password2'];
	$nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
	$email=$_POST['email'];


	$errores = '';

	// Comprobamos que ninguno de los campos este vacio. 
	
		if (empty($usuario) or empty($pass) or empty($nombre) or empty($apellidos) or empty($email) ) 
		{
			$errores = '<li>Por favor rellena todos los datos correctamente</li>';
		} else {
	
			try {
				$pdo = new PDO('mysql:host=localhost;dbname=luran', 'root', '');
			} catch (PDOException $e) {
				echo "Error YYY:" . $e->getMessage();
			}
	
			$statement = $pdo->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
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
		$resultado= $pdo->query($query);

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
	<div class="card col-md-6 mt-8">
			<div class="card-header bg-success bg-opacity-50 text-center">
                <h1>
                    
                Registro
                </h1>
            </div>
		
		<div class="card-body">
		


		<form class="formulario" name="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			
				<div class="form-group mt-4">
					<i class=" fa fa-user md-3"></i><input  required  type="text" name="usuario" placeholder="Usuario">
					<i class=" fa fa-user md-3"></i><input required   type="email" name="email" placeholder="Email">
				</div>

				<div class="form-group mt-4">
				<i class=" fa fa-user md-3"></i><input  required  class="nombre " type="text" name="nombre" placeholder="Nombre">
				<i class=" fa fa-user md-3"></i><input  required class="apellidos" type="text" name="apellidos" placeholder="Apellido">
					
				</div>

			

				
                <div class="mt-4">
				<i class="icono izquierda fa fa-lock "></i><input required  class="password" type="password" name="password" placeholder="Contrase??a">
				<i class="icono izquierda fa fa-lock"></i><input required   type="password2" name="password2" placeholder="Repite la Contrase??a">
				</div>

				

				<div class="card-footer text-center mt-4">
                <button class="btn-success"   onclick="login.submit()" type="submit" value="Login">
                
                Entrar
                </button>
            </div>
			</form>
				<div class="align-items-center">
					<p>Ya tienes una cuenta?</p>
					<a href="login.php"> Inicia Sesi??n</a>
				</div>
			</div>
				</div> 
		</div>
		
		
			
		

	</div>	
</body>
</html>