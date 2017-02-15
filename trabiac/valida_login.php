<?php

	session_start();

	if ( isset($_SESSION["idusr"]) && isset($_SESSION["nome_usuario"]) && isset($_SESSION["email"]) && isset($_SESSION["status"]) ) {
		$logado    = true;
		$id_usr    = $_SESSION["idusr"];
		$nome_usr  = $_SESSION["nome_usuario"];
		$email_usr = $_SESSION["email"];
		
		$_SESSION["status"]="on";
		
	}
	else{
		$logado = false;
		$_SESSION["status"]="off";
	}
?>