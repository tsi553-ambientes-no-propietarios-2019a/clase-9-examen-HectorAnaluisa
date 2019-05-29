<?php
	include('../comun/utils.php');

	if($_SESSION['user']['rol'] == 'Administrador'){

		header('Location: ../admin.php');

	}elseif($_SESSION['user']['rol'] == 'Cliente'){

		header('Location: ../cliente.php');

	}


	


?>