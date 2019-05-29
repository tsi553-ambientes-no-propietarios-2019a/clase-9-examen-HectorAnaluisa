<?php
	include('comun/utils.php');
	if($_SERVER['SCRIPT_NAME'] == '/examen/cliente.php' && !isset($_SESSION['user'])){
		header('Location: index.php');
		exit;
	}

	$user_id = $_SESSION['user']['id'];

	function getProducts($conn) {
	
	$sql = "SELECT *
		FROM products";
		$res = $conn->query($sql);
		if ($conn->error) {
			header('Location: ../cliente.php?error_message=Ocurrió un error: ' . $conn->error);
		}
		$products = [];
		if($res->num_rows > 0) {
			while ($row = $res->fetch_assoc()) {
				$products[] = $row;
			}
		}
		return $products;
	}

	$productos = getProducts($conn);

	if($_POST){
		if (isset($_POST['combo']) && isset($_POST['cantidad'])){
			$prod = $_POST['combo'];
			$cant = $_POST['cantidad'];

			$sql_insert = "INSERT INTO pedido 
				(Cantidad, user, prod)
				VALUES ('$prod', '$user_id', '$prod')";

			$conn->query($sql_insert);

				if ($conn->error) {
					echo 'Ocurrió un error ' . $conn->error;
				} else {
					echo 'exito'; 
				}

		}
	}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Administrador</title>
</head>
<body>
	
	<a href="php/salir.php" >Salir</a>
	<h1>CLIENTE</h1>
	<h3>Realizar un pedido</h3>
	<form method="POST">
		
		<select name="combo" required="required">
			
			<option value="">Seleccione un producto</option>

			<?php foreach ($productos as $p) { ?>
				<option value="<?php echo $p['id'] ?>"><?php echo $p['nombreProd'] ?></option>
					
			<?php } ?>

		</select>
		<br><br>
		<input type="number" name="cantidad"  placeholder="Cantidad" required="required">
		<br><br>
		
		<button>Pedir</button>
		<br> <br>


	</form>

</body>
</html>