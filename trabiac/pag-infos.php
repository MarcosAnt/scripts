<?php require "footer.php";?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Informações | MakeRun</title>
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
					  <li  class="active"><a href="pag-infos.php">Informações</a></li>
					  <li><a href="calendario.php">Calendário</a></li>
					  <li><a href="login.php">Conta</a></li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="jumbotron">
			<h1>Do começo...</h1>     
			<div class="row">
				<div class="col-sm-6">
					<p>Para quem está começando o ideal é não se esforçar demais nos primeiros dias de treino.<br>
					Isto causará um desgaste muito grande já que o corpo ainda não está preparado.</p>
					<p>A dica é: estabeleça uma rotina de treino e procure bater pequenas metas uma de cada vez tanto na corrida em si como na alimentação.<br>Por exemplo:</p>
					<ul>
						<li><p>Caminhar pelo menos 30min todo dia de manhã ou pela tarde;</p></li>
						<li><p>Deixar de tomar refrigerante no almoço;</p></li>
						<p>Forçar o corpo um pouco de cada vez e buscar melhorar os habitos relacionados ao bom rendimento físico são os primeiros passos.</p>
					</ul>
				</div>
				<div class="col-sm-6">
					<img class="img-thumbnail" src="img/ilustra-maratonista.png" alt="ilustração de uma maratonista">
				</div>
			</div>
		</div>
		<?php echo $footer;?>
	</div>
</body>
</html>