<?php
	include('../comun/utils.php');
	if($_POST){
		if(isset($_POST['nombre']) && isset($_POST['type']) && isset($_POST['username']) && isset($_POST['password1']) && isset($_POST['password2'])){
			$nom = $_POST['nombre'];
			$rol = $_POST['type']; 
			$nick = $_POST['username'];
			$pass1 = $_POST['password1'];
			$pass2 = $_POST['password2']; 
			if($pass1 == $pass2){

				$sql_insert = "INSERT INTO user 
				(nombre, rol, username, password)
				VALUES ('$nom', '$rol', '$nick', MD5('$pass1'))";

				$conn->query($sql_insert);

				if ($conn->error) {
					echo 'Ocurrió un error ' . $conn->error;
				} else {
					header('Location: ../index.php');
				}

			}else{

				header('Location: ../registro.php?mensaje="Contraseñas no coinciden"'); 
			}

		}else{
			header('Location: ../registro.php?mensaje="Ingrese todos los campos"'); 
		}
	}


?>