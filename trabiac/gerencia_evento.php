<?php 
    require "footer.php"; 
    require "valida_login.php";
    require "functions.php";

    $acesso_negado=$fazer_login=false;


    if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET["idevt"]) && isset($_GET["idusr"]) )
    	
    	if( $_GET["idevt"]!="" && $_GET["idusr"]!="" && $_GET["idusr"]==$_SESSION["idusr"] ){
			$id_usr = $_SESSION["idusr"];
			$id_evt = pverificaCampo($_GET["idevt"]);
		}else
			$acesso_negado=true;

	elseif($logado && $_SERVER["REQUEST_METHOD"]=="POST"){
		$id_usr=$_SESSION["idusr"];
		$id_evt=$_SESSION["id_evt"];
	}else
		$fazer_login=true;

	if(!$acesso_negado && !$fazer_login){
	     
		$dbconn = conectaBD();
	    
	    $sql   = "SELECT * FROM maratona WHERE maratona.idproprietario='$id_usr' AND maratona.idmaratona='$id_evt'";
	    $query = pg_query($dbconn, $sql);

	    if(!$query)
        	die('<h1 style="color: red;">Falha de comunicação com o banco!</h1>');
    	else
	        if(pg_num_rows($query) != 1)
	            die('<h1 style="color: red;">Problema com informações de cadastro</h1>');


    	$_SESSION["id_evt"]=$id_evt;

        $maratona = pg_fetch_assoc($query);
        $string   = $maratona ["datahora"];

	    pg_close($dbconn);
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Calendário de Eventos | MakeRun</title>
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
		#titulo{
			text-align: center;
			font-size: 35px;
			padding: 0px;
		}
		#cronometro{
			padding: 1cm;
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
					  <li ><a href="calendario.php">Calendário</a></li>
					  <li class="active"><a href="conta.php">Conta</a></li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="jumbotron">
		<?php if($acesso_negado || $fazer_login): ?>
			<div class="panel panel-default" style="padding: 10px">
				<p>Você Não Tem permissão para acessar este evento!!<br>
					Utilize sua pagina de perfil para criar uma maratona para gerenciar.
				</p>
				<a href="login.php">
                    <button class="btn btn-default btn-lg">Login ou Cadastro</button>
                </a>
			</div>
		<?php else: ?>
			<div class="row">
				<div  class="panel panel-default">
					<h1 id="titulo"><?php echo $maratona["nome_evento"] ?></h1>
				</div>
				<div class="col-sm-6" style="padding: 1cm">
                    <p>Cidade: <?php echo $maratona ["cidade"]; ?></p>
                    <p>Estado: <?php echo strtoupper($maratona ["estado"]); ?></p>
                    <p>Horário de Inicio: 
                        <?php 
                            echo $string[10];
                            echo $string[11]; 
                            echo $string[12];
                            echo $string[13];
                            echo $string[14];
                            echo $string[15];
                        ?>
                    </p>
                    <p>Local de largada: <?php echo $maratona ["local_saida"]; ?></p>
                    <p>Local de chegada: <?php echo $maratona ["local_chegada"]; ?></p>
                    <p>Percurso: <?php echo $maratona["percurso"]; ?></p><br>
					<a href="conta.php">
						<button type="button" class="btn btn-warning">Encerrar Maratona</button>
					</a>
					<a href="ranking.php?id_evt=<?php echo $id_evt ?>">
						<button type="button" class="btn btn-default">Ranking</button>
					</a>
				</div>
				<div id="cronometro" class="col-sm-6 panel panel-default">
					<form action="marcar_tempo.php" method="GET">
						<div class="form-group">
							<label for="idmaratonista">Núemro da Camiseta:</label>
							<input id="idmaratonista" class="form-control" type="text" name="idmaratonista" value="">
							<input id="id_evt" style="display: none;" class="form-control" type="text" name="id_evt" value="<?php echo $id_evt ?>">
						</div>
						<div class="form-group">
							<label for="tempo_inicio">Iniciar Tempo de Prova:</label>
							<input id="tempo_inicio" class="form-control" type="text" name="tempo_inicio" value="" placeholder="00:00:00">
						</div>
						<div class="form-group">
							<label for="tempo_termino">Finalizar Tempo de Prova:</label>
							<input id="tempo_termino" class="form-control" type="text" name="tempo_termino" value="" placeholder="00:00:00">
						</div>
							<button type="submity" class="btn btn-md btn-primary">Marcar Tempo</button>
					</form>
				</div>
			</div>
		</div>

		<?php endif; ?>
		<?php echo $footer;?>
	</div>	
</body>
</html>