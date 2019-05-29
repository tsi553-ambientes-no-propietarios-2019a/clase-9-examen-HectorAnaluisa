<?php
	include('comun/utils.php');

	if( $_SERVER['SCRIPT_NAME'] == '/examen/index.php' && isset($_SESSION['user']) ) {
	header('Location: php/procces_ini.php'); 
	exit; 
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inicio de sesion</title>
</head>
<body>

	<h1>Iniciar Sesión</h1>

<form action="php/process_login.php" method="POST">
<input type="text" name="username"  placeholder="Nombre de usuario" required="required">
<br><br>
<input type="password" name="password"  placeholder="Contraseña" required="required">
<br><br>
<button>Ingresar</button>
<a href="registro.php">Registrarse</a>
<br><br>
</form>




</body>
</html>