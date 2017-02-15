<?php 
    require "footer.php";
    require "valida_login.php";
    require "functions.php";        

    $kit2=0;
    
    $dbconn = conectaBD();
    
    $session_idusr = $_SESSION["idusr"];
    $idevt = verificaCampo($_GET["idevt"]);

    if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "POST" ) {
        
        if(isset($_GET["idevt"]) && isset($_GET["acao"]) && $_GET["acao"]=="cancel" ){
            $acao = verificaCampo($GET["acao"]);
            $sql  = "DELETE FROM usuario_maratona WHERE idusuario=$session_idusr AND idmaratona=$idevt";
            
            $resultado_busca_maratonas = pg_query($dbconn, $sql);
            if (!$resultado_busca_maratonas) {
                die("Problemas no delete pendentes.");
            }
            
            header("Location: /trabiac/descr_ev_private.php?idevt=$idevt");
            exit(0);

        }elseif(isset($_GET["idevt"]) && isset($_GET["acao"]) && $_GET["acao"]=="inscrever"){
            $acao = verificaCampo($_GET["acao"]);
            
            $kit        = verificaCampo($_POST["kit"]);
            $camiseta   = verificaCampo($_POST["camiseta"]);
            $modalidade = verificaCampo($_POST["modalidade"]);
                
            
            switch($modalidade){
                case 'Geral Masculino 42km':
                    $modalidade = 1;
                    break;
                case 'Geral Masculino 21km':
                    $modalidade = 2;
                    break;
                case 'Geral Masculino 10km':
                    $modalidade = 3;
                    break;
                case 'Geral Masculino 05km':
                    $modalidade = 4;
                    break;
                case 'Masculino 60+ anos 42km':
                    $modalidade = 5;
                    break;
                case 'Masculino 60+ anos 21km':
                    $modalidade = 6;
                    break;
                case 'Masculino 60+ anos 10km':
                    $modalidade = 7;
                    break;
                case 'Masculino 60+ anos 05km':
                    $modalidade = 8;
                    break;
                case 'Geral Feminino 42km':
                    $modalidade = 9;
                    break;
                case 'Geral Feminino 21km':
                    $modalidade = 10;
                    break;
                case 'Geral Feminino 10km':
                    $modalidade = 11;
                    break;
                case 'Geral Feminino 05km':
                    $modalidade = 12;
                    break;  
                case 'Feminino 60+ anos 42km':
                    $modalidade = 13;
                    break;
                case 'Feminino 60+ anos 21km':
                    $modalidade = 14;
                    break;
                case 'Feminino 60+ anos 10km':
                    $modalidade = 15;
                    break;
                case 'Feminino 60+ anos 05km':
                    $modalidade = 16;
                    break;
            }
            switch($kit){
                    case 'Vip':
                        $kit2 = 1;
                        break;
                    case 'Plus':
                        $kit2 = 2;
                        break;
                    case 'Básico':
                        $kit2 = 3;
                        break;
            }
            $sql="INSERT INTO usuario_maratona(idusuario, idmaratona, modalidade, kit, camiseta) VALUES ('$session_idusr', '$idevt', '$modalidade', '$kit2', '$camiseta')";

            $resultado_inscricao = pg_query($dbconn, $sql);
            if (!$resultado_inscricao) {
                die("Problemas no insert pendentes.");
            }
            header("Location: /trabiac/descr_ev_private.php?idevt=$idevt");
            exit(0);
        }
    }

    $sql = "SELECT * FROM maratona WHERE idmaratona = $idevt";
    $resultado_busca_maratonas = pg_query($dbconn, $sql);
    if (!$resultado_busca_maratonas) {
        die("Problemas no select pendentes.");
    }
    $maratona = pg_fetch_assoc($resultado_busca_maratonas);
    $idmaratona = $maratona["idmaratona"];

    $sql = "SELECT idinscr FROM usuario_maratona WHERE idmaratona={$idmaratona} AND idusuario={$session_idusr}";
    $resultado_busca_maratonas = pg_query($dbconn, $sql);

    if((pg_num_rows($resultado_busca_maratonas) == 0)){
        $inscrito = false;
    }else{
        $inscrito = true;
    }

    $inscricao_usuario = pg_fetch_assoc($resultado_busca_maratonas);
    $sql="SELECT * FROM usuario WHERE idusuario=$session_idusr";
    $resultado = pg_query($dbconn, $sql);
    if (!$resultado) {
         die("Problemas no select pendentes.");
    }
    $usuario = pg_fetch_assoc($resultado);
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
                    <div class="panel panel-default">
                        <?php if($inscrito==true): ?>
                            <div class="panel-heading"> 
                                <p>Seu Nº de Inscrição: <?php echo $inscricao_usuario["idinscr"]; ?></p>
                            </div>

                        <?php endIf; ?>
                        <div style="padding: 1cm">
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
                            <div class="panel-footer">
                                <div>
                                    <p>Kit Vip - Camiseta, sacola de treino, medalha participação e Jaqueta esportiva = R$180,00</p>
                                    <p>Kit Plus - Camiseta, boné, sacola de treino, medalha participação e cinto de hidratação = R$130,00</p>
                                    <p>Kit Básico - Camiseta, boné, sacola de treino e medalha participação = R$100,00</p>
                                </div>
                                <?php if($inscrito==true): ?>
                                    <form class="form-inline" method="POST" action="descr_ev_private.php?idevt=<?php echo $idevt?>&idusr<?php echo $session_idusr?>&acao=cancel">
                                        <div>
                                            <button type="submit" class="btn btn-danger">Cancelar Inscrição</button>
                                        </div>
                                    </form>
                                    <?php else: ?>
                                    <form class="form-inline" method="POST" action="descr_ev_private.php?idevt=<?php echo $idevt?>&acao=inscrever">
                                        <div>
                                            <label for="kit">Kit escolhido:</label>
                                            <select class="form-control" name="kit" value="<?php echo $kit; ?>" title="Selecionar">
                                                <option>Vip</option>
                                                <option>Plus</option>
                                                <option>Básico</option>
                                            </select>
                                        </div>

                                        <div style="padding-top: 10px">
                                            <label for="modalidade">Modalidade:</label>
                                            <select class="form-control" name="modalidade" value="<?php echo $modalidade; ?>" title="Selecionar">
                                                <?php if($usuario["sexo"]=="Masculino"): ?>
                                                    <option>Selecionar</option>
                                                    <option>Geral Masculino 42km</option>
                                                    <option>Geral Masculino 21km</option>
                                                    <option>Geral Masculino 10km</option>
                                                    <option>Geral Masculino 05km</option>
                                                    <option>Masculino 60+ anos 42km</option>
                                                    <option>Masculino 60+ anos 21km</option>
                                                    <option>Masculino 60+ anos 10km</option>
                                                    <option>Masculino 60+ anos 05km</option>
                                                <?php else: ?>
                                                    <option>Selecionar</option>
                                                    <option>Geral Feminino 42km</option>
                                                    <option>Geral Feminino 21km</option>
                                                    <option>Geral Feminino 10km</option>
                                                    <option>Geral Feminino 05km</option>
                                                    <option>Feminino 60+ anos 42km</option>
                                                    <option>Feminino 60+ anos 21km</option>
                                                    <option>Feminino 60+ anos 10km</option>
                                                    <option>Feminino 60+ anos 05km</option>
                                                <?php endIf ?>
                                            </select>
                                        </div>
                                        <div style="padding-top: 10px">
                                            <label for="camiseta">Camiseta:</label>
                                            <select class="form-control" name="camiseta" value="<?php echo $camiseta; ?>" title="Selecionar">
                                                <option>PP</option>
                                                <option>P</option>
                                                <option>M</option>
                                                <option>G</option>
                                                <option>GG</option>
                                            </select>
                                        </div>
                                        <div style="padding-top: 10px">
                                            <button type="submit" class="btn btn-success">Me Inscrever</button>
                                        </div>
                                    </form>
                                <?php endIf; ?>
                            </div>
                        </div>
                    </div>
			</div>
		</div>
		<?php echo $footer;?>
    </div>
</body>
</html>