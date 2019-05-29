<?php
	include('comun/utils.php');

	if($_SERVER['SCRIPT_NAME'] == '/examen/admin.php' && !isset($_SESSION['user'])){
		header('Location: index.php');
		exit;
	}

	$id = $_SESSION['user']['id'];
	//echo $id; 

	if($_POST){
		if (isset($_POST['prod']) && isset($_POST['valor'])){
			$prod = $_POST['prod'];
			$cant = $_POST['valor'];

			$sql_insert = "INSERT INTO products 
				(nombreProd, precio, user)
				VALUES ('$prod', '$cant', '$id')";

			$conn->query($sql_insert);

				if ($conn->error) {
					echo 'Ocurrió un error ' . $conn->error;
				} else {
					echo 'exito'; 
				}

		}
	}

function getProducts($conn) {
	$user_id = $_SESSION['user']['id'];
	$sql = "SELECT *
		FROM products
		WHERE user='$user_id'";
		$res = $conn->query($sql);
		if ($conn->error) {
			redirect('../home.php?error_message=Ocurrió un error: ' . $conn->error);
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

function getProductsTabla2($conn) {
	$user_id = $_SESSION['user']['id'];
	$sql = "SELECT user.username, products.nombreProd, pedido.Cantidad, products.precio * pedido.Cantidad as Total 
			FROM pedido, products, user WHERE pedido.prod = products.id and user.id = pedido.user";
		$res = $conn->query($sql);
		if ($conn->error) {
			redirect('../home.php?error_message=Ocurrió un error: ' . $conn->error);
		}
		$products = [];
		if($res->num_rows > 0) {
			while ($row = $res->fetch_assoc()) {
				$products[] = $row;
			}
		}
		return $products;
}

	$total = getProductsTabla2($conn);


?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrador</title>
</head>
<body>
	<a href="php/salir.php" >Salir</a>
	<h1>ADMINISTRADOR</h1>

	<h3>Registro de Productos</h3>

		<form  method="POST">
		<input type="text" name="prod"  placeholder="Producto" required="required">
		<br><br>
		<input type="number" name="valor"  placeholder="Precio unitario" required="required">
		<br><br>
		<button>Registrar</button>
		<br><br>
		</form>

	<h3>Productos Registrados</h3>
	<table border="1">
		<thead>
			<tr>
				<th>Producto</th>
				<th>Precio</th>
			
			</tr>
		</thead>
		<tbody>
			<?php foreach ($productos as $p) { ?>
				<tr>
					<td><?php echo $p['nombreProd'] ?></td>
					<td><?php echo $p['precio'] ?></td>
				
				</tr>
			<?php } ?>
		</tbody>

		
	</table>

	<h3>Pedidos</h3>

	<table border="1">
		<thead>
			<tr>
				<th>Cliente</th>
				<th>Producto</th>
				<th>Cantidad Pedida</th>
				<th>Total a Pagar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($total as $p) { ?>
				<tr>
					<td><?php echo $p['username'] ?></td>
					<td><?php echo $p['nombreProd'] ?></td>
					<td><?php echo $p['Cantidad'] ?></td>
					<td><?php echo $p['Total'] ?></td>
				
				</tr>
			<?php } ?>
		</tbody>

	</table>

</body>
</html>