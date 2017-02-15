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
		<div class="jumbotron" style="background-color: lavender;">
			<div class="page-header">
				<h1>Make Run</h1>
			</div>
            <div class="col-sm-6">
                <img class="img-thumbnail" src="img/icone.png" alt="icone do site">
            </div>
			<p>O portal Make Run para corredores de maratonas de rua foi desenvolvido com a intenção
                de tornar mais fácil a inscrição em maratonas próximas a você. 
                <br><br> Dentro do portal você pode acessar dicas para maratonistas clicando em "Informações" no menu
                que fica na parte superior da página, pode visualizar futuras maratonas clicando em "Calendário". 
                <br>Para realizar inscrições é necessário possuir uma conta no portal, clicando em "Conta" você pode
                criar uma nova conta totalmente gratuita e completar o seu cadastro com as informações necessárias.
                O portal apresenta também uma área para perguntas frequentes ("FAQ") e informações de contato com
                os proprietários do site.
                <br><br>O portal não tem fins lucrativos e em momento algum será cobrada taxa para utilização do mesmo. Além disso, toda e qualquer inscrição é de responsabilidade do usuário e o pagamento da taxa
                de inscrição é recebido pelo proprietário da maratona, sendo necessário
                contato com ele(a) caso haja dúvidas sobre o evento. As informações de contato do evento
                estarão disponíveis na página de informações sobre a maratona em questão.
            
			     <br><br>A equipe de desenvolvedores se preocupou em tornar fácil e rápido o acesso ao
                portal, com simples opções e usabilidade intuitiva. 
                <br><br>Desejamos que você tenha uma ótima experiência e volte sempre!
            </p>
		</div>
		<?php echo $footer;?>
	</div>    
</body>
</html>