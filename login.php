<?php
 include("global/config.php");
 include("global/conexion.php");

session_start();


// Comprobamos si ya han sido enviado los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = filter_var(strtolower($_POST['username']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	//$password = hash('sha512', $password);

}


if($_SERVER["REQUEST_METHOD"]=="POST")

{

	$username=$_POST["usuario"];

	$password=$_POST["contra"];

	$statement = $pdo->prepare('SELECT * FROM usuarios WHERE usuario = :username AND contrasenia = :password and activo = 1' );
	$statement->execute(array(
			':username' => $username,
			':password' => $password,
			
		));
		$result = $statement->fetch();


	if($result!=''){

		
		$_SESSION["username"]=$username;
		 $id= $result["id"];
		 $_SESSION["id"]=$id;
		
		header("location: productos.php");
		
	}


	}
	



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<link rel="shortcut icon" href="img/Botella.ico">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    

</head>

<body>

<div class="d-flex flex-column align-items-center mt-2">
<div class="card col-md-2 mt-4">

            <div class="card-header bg-success bg-opacity-50 text-center">
                <h1>
                    <i class="fas fa-door-open fa-2x"></i>
                Login
                </h1>
            </div>

            <form action="#" method="post">

            <div class="card-body">
                <div class="form-group" id="group-usuario">
                    <label for="usuario"><strong>Usuario:</strong></label>
                    <input name="usuario" id="usuario" class="form-control" type="text" required>
                </div>

                <div>
                    <div class="form-group" id="group-contra">
                        <label for="contra"><strong>Contraseña:</strong></label>
                        <input name="contra" id="contra" class="form-control" type="password" required> 
                    </div>
                </div>
            </div>

            <div class="card-footer text-center">
                <button class="btn btn-success" type="submit" value="Login">
                <i class="fas fa-sign-in"></i>
                Entrar
                </button>
            </div>

            </form>


				<div class="card-footer text-center">
                <button class="btn " type="submit" value="Login">
                ¿ Aun no tienes cuenta? <br>
				<a href="registro.php">Regístrate</a>
				
                </button>
            </div>

        </div>
</div>
</body>

</html>

