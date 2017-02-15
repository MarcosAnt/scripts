<?php include "footer.php";?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Bem Vindo | MakeRun</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="img/icon.png" type="image/x-icon">
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--CSS do Bootstrap-->
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
					  <li><a href="login.php">Conta</a></li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="jumbotron">
            <h2>Entre em contato conosco somente em extrema necessidade!</h2>
            <p>
            <br>
            Fone: (41) 99999-9999
            <br>
            Email: makerun@makerun.com
            </p>
		</div>
		<?php echo $footer;?>
	</div>    
</body>
</html>