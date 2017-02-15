<?php require "footer.php";?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Bem Vindo | MakeRun</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="img/icon.png" type="image/x-icon">
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
		<header class="menu" id="menu">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="home.php">
							<img id="logoNavbar" src="img/icone.png" alt="MakeRun"/>
						</a>
					</div>
					<ul class="nav navbar-nav">
					  <li class="active"><a href="home.php">Início</a></li>
					  <li><a href="pag-infos.php">Informações</a></li>
					  <li><a href="calendario.php">Calendário</a></li>
					  <li><a href="login.php">Conta</a></li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="jumbotron">
			<div class="page-header">
				<h1>Controle suas maratonas</h1>
			</div>
			<p>No portal MakeRun você pode se inscrever em grandes maratonas de rua já reconhecidas pelos maratonistas e em diversas outras novas maratonas, mas além disso...</p>
			<p>Você pode criar sua própria maratona e divulgar seu evento unindo esporte, lazer e diversão.</p>
			<a href="login.php"><button class="btn btn-primary btn-lg" name="inscricao">Inscreva-se</button></a>
		</div>
		<?php echo $footer;?>
	</div>
</body>
</html>