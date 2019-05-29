<?php
	include("comun/utils.php"); 

	if( $_SERVER['SCRIPT_NAME'] == '/examen/registro.php' && isset($_SESSION['user']) ) {
	header('Location: php/procces_ini.php'); 
	exit; 
	}

	if($_GET){
		if(isset($_GET['mensaje'])){
			$llega = $_GET['mensaje']; 
			echo $llega;
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
</head>
<body>
	<h1>REGISTRO DE USUARIOS</h1>

<form action="php/procces_regist.php" method="POST">
<input type="text" name="nombre"  placeholder="Nombre" required="required" >
<br> <br>
<select name="type" required="required">
	<option value="">Seleccione...</option>
	<option value="Administrador">Administrador</option>
	<option value="Cliente">Cliente</option>

</select>
<br><br>
<input type="text" name="username"  placeholder="Nombre de usuario" required="required">
<br><br>
<input type="password" name="password1"  placeholder="Contraseña" required="required">
<br> <br>
<input type="password" name="password2"  placeholder="Repita su Contraseña" required="required">
<br> <br>
<button>Registrar</button>
<br> <br>


</form>
</body>
</html>