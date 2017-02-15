<?php 
    require "footer.php";
    require "functions.php";       
    
    $resultado_busca_maratonas="";
    //estabelecendo conexão
    //makerun é minha db e maruve é minha senha xD
     
	$dbconn = conectaBD();
    
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET["busca"]))
        {
            $busca = verificaCampo($_GET["busca"]);
            
            //comando num switch, poderia ser diferente mas de qualquer forma teria que fazer algo assim
            switch($busca)
            {
                case 'janeiro':
                    $sql = "SELECT * FROM maratona WHERE (EXTRACT(MONTH FROM datahora)) = 01";
                    break;
                case 'fevereiro':
                    $sql = "SELECT * FROM maratona WHERE (EXTRACT(MONTH FROM datahora)) = 02";
                    break;
                case 'marco':
                    $sql = "SELECT * FROM maratona WHERE (EXTRACT(MONTH FROM datahora)) = 03";
                    break;
                case 'abril':
                    $sql = "SELECT * FROM maratona WHERE (EXTRACT(MONTH FROM datahora)) = 04";
                    break;
                case 'maio':
                    $sql = "SELECT * FROM maratona WHERE (EXTRACT(MONTH FROM datahora)) = 05";
                    break;
                case 'junho':
                    $sql = "SELECT * FROM maratona WHERE (EXTRACT(MONTH FROM datahora)) = 06";
                    break;
                case 'julho':
                    $sql = "SELECT * FROM maratona WHERE (EXTRACT(MONTH FROM datahora)) = 07";
                    break;
                case 'agosto':
                    $sql = "SELECT * FROM maratona WHERE (EXTRACT(MONTH FROM datahora)) = 08";
                    break;
                case 'setembro':
                    $sql = "SELECT * FROM maratona WHERE (EXTRACT(MONTH FROM datahora)) = 09";
                    break;
                case 'outubro':
                    $sql = "SELECT * FROM maratona WHERE (EXTRACT(MONTH FROM datahora)) = 10";
                    break;
                case 'novembro':
                    $sql = "SELECT * FROM maratona WHERE (EXTRACT(MONTH FROM datahora)) = 11";
                    break;
                case 'dezembro':
                    $sql = "SELECT * FROM maratona WHERE (EXTRACT(MONTH FROM datahora)) = 12";
                    break;
                default:
                    $sql = "SELECT * FROM maratona";
                    break;
            }            
            //query
            $resultado_busca_maratonas = pg_query($dbconn, $sql);
            if (!$resultado_busca_maratonas) {
                die("Problemas no select pendentes.");
            }
        }else{
            //comando
              $sql = "SELECT * FROM maratona";
            //query
              $resultado_busca_maratonas = pg_query($dbconn, $sql);
            //verificacao da resposta
              if (!$resultado_busca_maratonas) {
                die("Problemas no select pendentes.");
              }
        }
    }else{
        //comando
          $sql = "SELECT * FROM maratona";
        //query
          $resultado_busca_maratonas = pg_query($dbconn, $sql);
        //verificacao da resposta
          if (!$resultado_busca_maratonas) {
            die("Problemas no select pendentes.");
          }
    }


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
					  <li class="active"><a href="calendario.php">Calendário</a></li>
					  <li><a href="login.php">Conta</a></li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="jumbotron">
			<div class="row">
				<div class="col-sm-2" >
					<ul class="list-group">
                        <li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "todas"; ?>">Todas</a></li>
						<li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "janeiro"; ?>">Janeiro</a></li>
						<li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "fevereiro"; ?>">Fevereiro</a></li>
						<li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "marco"; ?>">Março</a></li>
						<li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "abril"; ?>">Abril</a></li>
						<li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "maio"; ?>">Maio</a></li>
						<li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "junho"; ?>">Junho</a></li>
						<li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "julho"; ?>">Julho</a></li>
						<li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "agosto"; ?>">Agosto</a></li>
						<li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "setembro"; ?>">Setembro</a></li>
						<li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "outubro"; ?>">Outubro</a></li>
						<li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "novembro"; ?>">Novembro</a></li>
						<li class="list-group-item">
                            <a href="calendario.php?busca=<?php echo "dezembro"; ?>">Dezembro</a></li>
					</ul>
				</div>
                
                
                <div>
                    <?php if(pg_num_rows($resultado_busca_maratonas) == 0): ?>
                    
                        <div class="col-sm-10" style="float: right">
                            <div class="panel panel-default" >
                                <div class="panel-heading">
                                    <div class="row" id="evento">
                                        <div class="col-sm-9 descr-ev">
                                            <h1 style="font-size: 250%"> 
                                                Infelizmente estamos sem maratonas no momento, volte outra hora :c
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                            <?php while($maratona = pg_fetch_assoc($resultado_busca_maratonas)): ?>
                                <div class="col-sm-10" style="float: right">
                                    <div class="panel panel-default" >
                                        <div class="panel-heading">
                                            <div class="row" id="evento">
                                                <div class="col-sm-2 date-ev" style="margin: 0.3cm;">
                                                    <h1>
                                                        <?php 
                                                        //""gambiarra"" pra pegar a data e hora, cada caractere de "datahora" agora é um indice de $string (que é um vetor)
                                                            $string = $maratona ["datahora"];
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
                                                <div class="col-sm-9 descr-ev">
                                                    <h1 style="font-size: 250%">
                                                        <?php echo $maratona["nome_evento"]; ?>
                                                    </h1>
                                                    <p style="font-size: 130%;margin: 0.3cm;">Cidade: <?php echo $maratona["cidade"]; ?></p>
                                                    <p style="font-size: 130%;margin: 0.3cm;">Estado: <?php echo strtoupper($maratona ["estado"]); ?></p>
                                                    <p style="font-size: 130%;margin: 0.3cm;">Horário: 
                                                        <?php 
                                                            echo $string[10];
                                                            echo $string[11]; 
                                                            echo $string[12];
                                                            echo $string[13];
                                                            echo $string[14];
                                                            echo $string[15];
                                                        ?>
                                                    </p>
                                                    <p style="font-size: 130%;margin: 0.3cm;">Data: 
                                                        <?php
                                                            echo $string[8];
                                                            echo $string[9]; 
                                                            echo "/" . $string[5];
                                                            echo $string[6];
                                                            echo "/" . $string[0];
                                                            echo $string[1];
                                                            echo $string[2];
                                                            echo $string[3];
                                                        ?>
                                                    </p>
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