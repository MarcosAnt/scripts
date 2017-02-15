<?php

	function verificaCampo($texto){
	  $texto = trim($texto);
	  $texto = stripslashes($texto);
	  $texto = htmlspecialchars($texto);
	  $texto = pg_escape_string($texto);
	  return $texto;
	}
	//fim verificaCampo()

	function conectaBD(){
		$strconn = "host=localhost port=5432 dbname=makerun user=postgres password=";

		$conexao = pg_connect($strconn);

		if(!$conexao)
            die('<h1 style="color: red;">Falha ao conectar no banco!</h1>');

        return ($conexao);
	}
	//fim conectaBD()

	

?>
