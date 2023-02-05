<?php
 include("../global/config.php");
 include("../global/conexion.php");

session_start();

// Comprobamos si ya han sido enviado los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = filter_var(strtolower($_POST['username']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	//$password = hash('sha512', $password);

}


if($_SERVER["REQUEST_METHOD"]=="POST")

{

	$username=$_POST["username"];

	$password=$_POST["password"];

	$statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :username AND contrasenia = :password and activo = 1' );
	$statement->execute(array(
			':username' => $username,
			':password' => $password,
			
		));
		$result = $statement->fetch();


	if($result!=''){

		
		if($result["tipo"]=="1")

	{	



		$_SESSION["username"]=$username;
		 $id= $result["id"];
		 $_SESSION["id"]=$id;

			header("location: ../Admin/productos.php  ");

	}



	elseif($result["tipo"]=="2")

	{

		$_SESSION["username"]=$username;
		 $id= $result["id"];
		 $_SESSION["id"]=$id;
		
		

		$state = $conexion->prepare("select * from cliente where id=' $_SESSION[id]' ");
		$state->execute();
		$cliente = $state->fetch();

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

		$_SESSION["IdCliente"]=$Idcliente;
		$_SESSION["nombre"]=$nombre;
		$_SESSION["apellidoM"]=$apellidoM;
		$_SESSION["apellidoP"]=$apellidoP;
		$_SESSION["telefono"]=$telefono;
		$_SESSION["mail"]=$mail;
		$_SESSION["ciudad"]=$ciudad;
		$_SESSION["exterior"]=$exterior;
		$_SESSION["interior"]=$interior;
		$_SESSION["colonia"]=$colonia;
		$_SESSION["calle"]=$calle;
		$_SESSION["cp"]=$cp;
		$_SESSION["rfc"]=$rfc;
		$_SESSION["domf"]=$domf;

			header("location: productos.php");

	}


	}
	
	else

	{
		echo "Usuario o contraseña incorrectos";
	}


}




?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?></title>
    <link rel="shortcut icon" href="img/usuario.ico">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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

			   <p class="texto-registrate">
				¿ Aun no tienes cuenta ?
				<a href="registro.php">Regístrate</a>
				</p>


        </div>
</div>
</body>

</html>

