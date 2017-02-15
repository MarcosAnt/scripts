<?php 
	$strconn = "host=localhost port=5432 dbname=postgres user=postgres password=admin";
	
	$dbconn = pg_connect($strconn);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Exemplo de conexão com o Postgres</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="img/icon.png" type="image/x-icon">
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--CSS do Bootstrap-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><!--JavaScript do Bootstrap-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><!--jQuerry-->
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<div class="page-header">
				<?php
					if($dbconn){
						echo "<p>Conectado ao Banco Postgres com Sucesso!</p>";
					}else{
						echo"<p>Falha ao conectar ao Banco Postgres: " . pg_last_error($dbconn) . "</p>";
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>