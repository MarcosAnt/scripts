<?php

	require "footer.php";
	require "valida_login.php";
	require "functions.php"

	$id_evt = verificaCampo($_GET["id_evt"]);

    $dbconn = conectaBD();

    $select_aux = "SELECT *, hora_termino - hora_inicio AS tempo_prova FROM usuario_maratona 
    				WHERE idmaratona=$id_evt AND hora_termino!=hora_inicio ORDER BY tempo_prova"; 
	
	$query_aux = pg_query($dbconn, $select_aux);
    if(!$query_aux)
        die('<h1 style="color: red;">Falha de comunicação com o banco!</h1>');

    $result_aux=pg_fetch_assoc($query_aux);
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Perfil | MakeRun</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--CSS do Bootstrap-->
	<link rel="stylesheet" href="estilos.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><!--JavaScript do Bootstrap-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><!--jQuerry-->
	<style>
		#logoNavbar{
			height: 100%;
			margin: 3px;
		}
	</style>
</head>
<body id="pag">
    <div class="container">
		<header class="menu">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="home.php">
							<img id="logoNavbar" src="img/icone.png" alt="MakeRun"/>
						</a>
					</div>
					<ul class="nav navbar-nav">
					  <li><a href="home.php">Início</a></li>
					  <li><a href="pag-infos.php">Informações</a></li>
					  <li><a href="calendario.php">Calendário</a></li>
					  <li class="active"><a href="conta.php">Conta</a></li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="jumbotron">
			<?php
					$select_mta="SELECT nome_evento, datahora FROM maratona WHERE idmaratona=$id_evt";

				    $query_mta = pg_query($dbconn, $select_mta);
				    if(!$query_mta)
				        die('<h1 style="color: red;">Falha de comunicação com o banco!</h1>');

				    $maratona = pg_fetch_assoc($query_mta);

				 	$select_usr="SELECT idusuario,nome_usuario FROM usuario";
				 	$query_usr = pg_query($dbconn, $select_usr);
				    if(!$query_usr)
				        die('<h1 style="color: red;">Falha de comunicação com o banco!</h1>');

				 	pg_close($dbconn);


				echo '
				    <div class="panel panel-default">
				    <div class="panel panel-heading">
				    	<p>'. $maratona["nome_evento"] .'</p>
				    </div>
					<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>Nº Inscrição</th>
								<th>Maratonista</th>
								<th>Tempo de Prova</th>
								<th>Modalidade</th>
								<th>Kit Adquirido</th>
							</tr>
						</thead>
						<tbody>';

				while($usuario=pg_fetch_assoc($query_usr)){
					if( $result_aux["idusuario"] == $usuario["idusuario"] ){
		        		$string = $maratona ["datahora"];
						echo"
					      <tr>
					        <td>{$result_aux["idinscr"]}</td>
					        <td>{$usuario["nome_usuario"]}</td>
					        <td>{$result_aux["tempo_prova"]}</td>
					        <td>{$result_aux["modalidade"]}</td>
					        <td>{$result_aux["kit"]}</td>
					      </tr>";
					}
				}

				echo '</tbody>
				</table>
				</div>

				</div>';
			?>
			<a href="meu_evento.php">
				<button class="btn btn-default">Voltar à Conta</button>
			</a>
		</div>
		<?php echo $footer;?>
	</div>
</body>
</html>