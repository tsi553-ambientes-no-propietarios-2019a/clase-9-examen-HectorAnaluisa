<?php
 include('../comun/utils.php');

if($_POST) {
	if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "SELECT *
		FROM user
		WHERE username='$username'
		AND password=MD5('$password')";
		$res = $conn->query($sql);
		if ($conn->error) {
			header('Location: ../index.php?error_message=Ocurrió un error: ' . $conn->error);
		}
		if($res->num_rows > 0) {
				while ($row = $res->fetch_assoc()) {
					$_SESSION['user'] = [
						'username' => $row['username'],
						'rol' => $row['rol'],
						'id' => $row['id']
					];
					header('Location: procces_ini.php');
				}
		} else {
			header('Location: ../index.php?error_message=Usuario o clave incorrectos!');
		}
	} else {
		header('Location: ../index.php?error_message=Ingrese todos los datos!');
	}
} else {
	header('Location: ../index.php');
}
?>