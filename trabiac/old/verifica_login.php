<?php
	require "valida_login.php";
	require "footer.php";

	if($logado){
		header("Location: /trabiac/conta.php");
		exit(0);
	}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Login | MakeRun</title>
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
        .msg_erro{
            color: red;
            font-size: 20px;
            text-align: center;
            border-radius: 3px;
            border: 1px solid red;
            background-color: #fedede;
            padding: 15px;
            margin-bottom: 15px;
        }
        a button{
        	margin-right: 45%;
        	margin-left: 45%;
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
					  <li class="active"><a href="login.php">Conta</a></li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="msg_erro">
			<p>Você precisa estar logado para acessar esta página.<br>Para continuar faça login ou cadastre-se.</p>
			<a href="login.php"><button type="submit" class="btn btn-default" >Ir para login</button></a>
		</div>
			<?php echo $footer;?>
	</div>
</body>
</html>