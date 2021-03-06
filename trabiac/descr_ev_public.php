<?php 
    require "footer.php";  
    require "valida_login.php";
    require "functions.php";
    function verifica_campo($texto){
        $texto = trim($texto);
        $texto = stripslashes($texto);
        $texto = htmlspecialchars($texto);
        return $texto;
    }
    $id = $_GET["idevt"];
    if($logado){
        header("Location: /trabiac/descr_ev_private.php?idevt=$id");
    }
    //estabelecendo conexão
    //makerun é minha db e maruve é minha senha xD
     
	$dbconn = conectaBD();
    
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET["idevt"])) {
            $id = verificaCampo($_GET["idevt"]);
            //comando
            $sql = "SELECT * FROM maratona WHERE idmaratona = $id";
            //query
            $resultado_busca_maratonas = pg_query($dbconn, $sql);
            if (!$resultado_busca_maratonas) {
                die("Problemas no select pendentes.");
            }
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
				<div class="col-sm-2 date-ev" style="margin: 0.3cm">
                    <h1>
                        <?php
                        $maratona = pg_fetch_assoc($resultado_busca_maratonas);
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
					<h1 style="font-size: 450%">
                        <?php
                            echo $maratona ["nome_evento"];
                        ?>
                    </h1>   
                    <p>Cidade: <?php echo $maratona ["cidade"]; ?></p>
                    <p>Estado: <?php echo strtoupper($maratona ["estado"]); ?></p>
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
                    <p>Local de largada: <?php echo $maratona ["local_saida"]; ?></p>
                    <p>Local de chegada: <?php echo $maratona ["local_chegada"]; ?></p>
                    <p>Percurso: <?php echo $maratona["percurso"]; ?></p>
                    <p>Fim das inscrições: 
                        <?php 
                            $string2 = $maratona ["data_fim_inscr"];
                            echo $string2[8]; 
                            echo $string2[9]; 

                            echo "/" . $string2[5]; 
                            echo $string2[6];
                            echo "/" . $string2[0]; 
                            echo $string2[1];
                            echo $string2[2]; 
                            echo $string2[3]; 
                        ?></p>
                    <p>Telefone para contato: 
                        <?php 
                            $string3 = $maratona ["fone_contato"];
                            echo "(" . $string3[0];
                            echo $string3[1];
                            echo ") " . $string3[2];
                            echo $string3[3];
                            echo $string3[4];
                            echo $string3[5];
                            echo $string3[6];
                            echo "-";
                            echo $string3[7];
                            echo $string3[8];
                            echo $string3[9];
                            echo $string3[10];
                        ?></p>
                </div>
			</div>
		</div>
		<?php echo $footer;?>
    </div>
</body>
</html>