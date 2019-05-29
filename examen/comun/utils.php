<?php

	session_start(); 
	$conn = new mysqli('localhost', 'root', '', 'examenb1');
	
	if($conn->connect_error) {
		echo 'Existió un error en la conexión ' . $conn->connect_error;
		exit;
	}

	
	
?>