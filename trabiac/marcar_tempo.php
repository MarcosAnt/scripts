<?php

	require "valida_login.php";
	require "functions.php";

	if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET["id_evt"]) ){
		$id_evt        = verificaCampo($_GET["id_evt"]);
    	$tempo_inicio  = verificaCampo($_GET["tempo_inicio"]);
    	$idmaratonista = verificaCampo($_GET["idmaratonista"]);
    	$tempo_termino = verificaCampo($_GET["tempo_termino"]);

		$dbconn = conectaBD($strconn);

	    $sql = "UPDATE usuario_maratona SET hora_inicio='${tempo_inicio}', hora_termino='{$tempo_termino}' WHERE idinscr={$idmaratonista} AND idmaratona={$id_evt}";
	    $query = pg_query($dbconn, $sql);

	    if(!$query)
        	die('<h1 style="color: red;">Falha de comunicação com o banco ou Dados Inconsistentes!</h1>');

        pg_close($dbconn);

        header("Location: /trabiac/gerencia_evento.php?idevt={$id_evt}&idusr={$id_usr}");
    }
?>
