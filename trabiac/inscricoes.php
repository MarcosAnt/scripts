<?php 
    require "footer.php"; 
    require "valida_login.php";
    require "functions.php";

    $id_usr = $_SESSION["idusr"];

    //estabelecendo conexão
    
	$dbconn = conectaBD();
    
    $sql       = "SELECT * FROM usuario_maratona, maratona WHERE maratona.idmaratona=usuario_maratona.idmaratona AND idusuario='$id_usr'";
    $resultado = pg_query($dbconn, $sql);

    //fechando conexão
    pg_close($dbconn);
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
			<div class="row">
                <div class="col-sm-2">
					<ul class="list-group">
						<li class="list-group-item"><a href="conta.php">Cadastro</a></li>
						<li class="list-group-item"><a href="inscricoes.php">Inscrições</a></li>
						<li class="list-group-item"><a href="conta.php?opc=ests">Estatisticas</a></li>
						<li class="list-group-item"><a href="meu_evento.php">Meu Evento</a></li>
						<li class="list-group-item"><a href="sair.php" style="color: red">Sair</a></li>
					</ul>
				</div>
                <div>
                    <?php if(pg_num_rows($resultado) == 0): ?>
                        <div class="col-sm-10" style="float: right">
                            <div class="panel panel-default" >
                                <div class="panel-body">
                                    <div class="row" id="evento">
                                        <div class="col-sm-9 descr-ev">
                                            <p style="margin: 10px">Você ainda não está inscrito em uma maratona. De uma olhada no nosso <a href="calendario.php">Calendário de Eventos</a> e se inscreva!!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                            <?php while($maratona = pg_fetch_assoc($resultado)): ?>
                                <?php 
                                    $correcao_nome = utf8_encode($maratona["nome_evento"]);
                                    $correcao_cidade = utf8_encode($maratona["cidade"]);
                                ?>
                                <div class="col-sm-10" style="float: right">
                                    <div class="panel panel-default" >
                                        <div class="panel-heading">
                                            <div class="row" id="evento">
                                                <div class="col-sm-2 date-ev" style="margin: 0.3cm">
                                                    <h1>
                                                        <?php
                                                            $string = $maratona["datahora"];
                                                            echo $string[8];
                                                            echo $string[9];
                                                        ?>
                                                    <br>
                                                        <?php
                                                            echo "/" . $string[5];
                                                            echo $string[6];
                                                        ?>
                                                    </h1>
                                                </div>
                                                <div class="col-sm-7 descr-ev">
                                                    <h1 style="font-size: 400%">
                                                        <?php
                                                            echo $maratona ["nome_evento"];
                                                        ?>
                                                    </h1>   
                                                    <p>Cidade: <?php echo $maratona["cidade"]; ?></p>
                                                    <p>Estado: <?php echo strtoupper($maratona["estado"]); ?></p>
                                                    <p>Horário: 
                                                        <?php 
                                                            echo $string[10];
                                                            echo $string[11]; 
                                                            echo $string[12];
                                                            echo $string[13];
                                                            echo $string[14];
                                                            echo $string[15];
                                                        ?>
                                                    </p>
                                                    <p>Local de largada: <?php echo $maratona["local_saida"]; ?></p>
                                                    <p>Local de chegada: <?php echo $maratona["local_chegada"]; ?></p>
                                                    <p>Percurso: <?php echo $maratona["percurso"]; ?></p>
                                                </div>
                                                
                                            </div>
                                        
                                        </div>
                                        <div class="panel-body btn-right">
                                            <a href="descr_ev_public.php?idevt=<?php echo $maratona["idmaratona"]; ?>"
                                               class="btn btn-link btn-sm" role="button">+ Saiba Mais</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endWhile; ?>
                        <?php endIf; ?>             
                </div>
			</div>
		</div>
		<?php echo $footer;?>
    </div>
</body>
</html>