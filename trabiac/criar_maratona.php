<?php
    require "footer.php";
    require "valida_login.php";
    require "functions.php";
    
    $errocriacao=false;
    $nome=$cidade=$estado=$localsaida=$localchegada=$fonecontato=$diamaratona="";
    $mesmaratona=$anomaratona=$diainscricao=$mesinscricao=$anoinscricao=$horario=$percurso=$horarioinscricao="";

    if(($logado && $_SERVER["REQUEST_METHOD"]=="POST"))
    {
            
        $diamaratona  = verificaCampo($_POST["diamaratona"]);
        $mesmaratona  = verificaCampo($_POST["mesmaratona"]);
        $anomaratona  = verificaCampo($_POST["anomaratona"]);
        $diainscricao = verificaCampo($_POST["diainscricao"]);
        $mesinscricao = verificaCampo($_POST["mesinscricao"]);
        $anoinscricao = verificaCampo($_POST["anoinscricao"]);
        $percurso     = verificaCampo($_POST["percurso"]) . "km";

        if(($diamaratona!="DD")&&($diainscricao!="DD")&&($mesmaratona!="MM")&&($mesinscricao!="MM")&&($anoinscricao!="AAAA")&&($anomaratona!="AAAA")&&($percurso!="KM"))
        {
        
            $dbconn = conectaBD();

            $nome_evento      = verificaCampo($_POST["nome"]);
            $cidade           = verificaCampo($_POST["cidade"]);
            $estado           = strtoupper(verificaCampo($_POST["estado"]));
            $localsaida       = verificaCampo($_POST["localsaida"]);
            $localchegada     = verificaCampo($_POST["localchegada"]);
            $fonecontato      = verificaCampo($_POST["fonecontato"]);
            $horario          = $_POST["horario"];
            $horarioinscricao = $_POST["horarioinscricao"];
            $datahora         = $anomaratona . "-" . $mesmaratona . "-" . $diamaratona . " " . $horario . ":00";
            $datainscricao    = $anoinscricao . "-" . $mesinscricao . "-" . $diainscricao . " " . $horarioinscricao . ":00";
            $insert           = "INSERT INTO maratona(nome_evento, idproprietario, cidade, estado, local_saida, local_chegada, fone_contato, datahora, data_fim_inscr, percurso) VALUES ('$nome_evento', '$id_usr', '$cidade', '$estado', '$localsaida', '$localchegada', '$fonecontato', '$datahora', '$datainscricao', '$percurso')";

            $query = pg_query($dbconn, $insert);
            if(!$query){
                die('Falha de comunicação com o banco!');
            }else{
                header("Location: /trabiac/meu_evento.php");
            }
            pg_close($dbconn);
        }else{
            $errocriacao=true;
        }
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
        .msg_erro_input_vazio{
            color: red;
            font-size: 7px;
            text-align: center;
            border-radius: 3px;
            border: 1px solid red;
            background-color: #fedede;
            margin: 10px;
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
		<div class="jumbotron">
            <div class="row" style="text-align: center;float: center;">
                <div class="page-header">
                    <h1 style="font-size: 300%;text-align: center">Minha Maratona</h1>
                </div>
                <div style="width: 60%; margin: auto">
                    <?php if($errocriacao): ?>
                        <div class="col-sm-12 msg_erro_input_vazio">
                            <p style="margin: 0px">Preencha as informações corretamente!</p>
                        </div>
                    <?php endif; ?>
                    <form class="form-inline" data-toggle="validator" method="POST" action="criar_maratona.php">
                        <div class="form-group">
                            <label for="nome">Nome da maratona:</label>
                            <input type="text" class="form-control" style="width: 55%;" name="nome" value="<?php echo $nome; ?>" required data-error="Você deve informar o nome da maratona!">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group" style="padding-top: 5px">
                            <label for="cidade" >Cidade:</label>
                            <input type="text" class="form-control" style="width: 30%;" name="cidade" value="<?php echo $cidade; ?>" required data-error="Você deve informar a cidade e o estado!">
                            
                            <label for="estado">Estado (sigla):</label>
                            <input type="text" class="form-control" style="width: 9%;" name="estado" value="<?php echo $estado; ?>" required data-error="Você deve informar a cidade e o estado!">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group" style="padding-top: 5px">
                            <label for="localsaida">Local Saída:</label>
                            <input type="text" class="form-control" name="localsaida" value="<?php echo $localsaida; ?>" required data-error="Você deve informar o local de saída!">
                            <div class="help-block with-errors"></div>
                        </div>
                        <br>
                        <div class="form-group" style="padding-top: 5px">
                            <label for="localchegada">Local Chegada:</label>
                            <input type="text" class="form-control" name="localchegada" value="<?php echo $localchegada; ?>" required data-error="Você deve informar o local de chegada!">
                            <div class="help-block with-errors"></div>
                        </div>
                        
                        <div class="form-group" style="padding-top: 5px">
                            <label for="fonecontato">Fone Contato (somente dígitos):</label>
                            <input type="text" class="form-control" name="fonecontato" value="<?php echo $fonecontato; ?>" required data-error="Você deve informar o telefone para contato!">
                            <div class="help-block with-errors"></div>
                        </div>
                        
                        <div style="padding-top: 5px">
                            <div class="form-group">
                                <label for="diamaratona">Data da maratona:</label>
                                <select class="form-control" name="diamaratona" value="<?php echo $diamaratona; ?>" title="DD">
                                    <option>DD</option>
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                    <option>13</option>
                                    <option>14</option>
                                    <option>15</option>
                                    <option>16</option>
                                    <option>17</option>
                                    <option>18</option>
                                    <option>19</option>
                                    <option>20</option>
                                    <option>21</option>
                                    <option>22</option>
                                    <option>23</option>
                                    <option>24</option>
                                    <option>25</option>
                                    <option>26</option>
                                    <option>27</option>
                                    <option>28</option>
                                    <option>29</option>
                                    <option>30</option>
                                    <option>31</option>
                                </select>
                                <select class="form-control" name="mesmaratona" value="<?php echo $mesmaratona; ?>" title="MM">
                                    <option>MM</option>
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                                <select class="form-control" name="anomaratona" value="<?php echo $anomaratona; ?>" title="AAAA">
                                    <option>AAAA</option>
                                    <option>2016</option>
                                    <option>2017</option>
                                    <option>2018</option>
                                    <option>2019</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" style="padding-top: 5px">
                            <label for="horario">Horário (ex: 16:00):</label>
                            <input type="text" class="form-control" style="width: 20%" name="horario" value="<?php echo $horario; ?>" required data-error="Você deve informar o horário e percurso!">
                                                    
                            <label for="percurso">Percurso:</label>
                            <select class="form-control" name="percurso" value="<?php echo $percurso; ?>" title="PP">
                                <option>KM</option>
                                <option>05</option>
                                <option>10</option>
                                <option>21</option>
                                <option>42</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div style="padding-top: 5px">
                            <div class="form-group">
                                <label for="diainscricao">Data de término das inscrições:</label>
                                <select class="form-control" name="diainscricao" value="<?php echo $diainscricao; ?>" title="DD">
                                    <option>DD</option>
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                    <option>13</option>
                                    <option>14</option>
                                    <option>15</option>
                                    <option>16</option>
                                    <option>17</option>
                                    <option>18</option>
                                    <option>19</option>
                                    <option>20</option>
                                    <option>21</option>
                                    <option>22</option>
                                    <option>23</option>
                                    <option>24</option>
                                    <option>25</option>
                                    <option>26</option>
                                    <option>27</option>
                                    <option>28</option>
                                    <option>29</option>
                                    <option>30</option>
                                    <option>31</option>
                                </select>
                                <select class="form-control" name="mesinscricao" value="<?php echo $mesinscricao; ?>" title="MM">
                                    <option>MM</option>
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                                <select class="form-control" name="anoinscricao" value="<?php echo $anoinscricao; ?>" title="AAAA">
                                    <option>AAAA</option>
                                    <option>2016</option>
                                    <option>2017</option>
                                    <option>2018</option>
                                    <option>2019</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group" style="padding-top: 5px">
                            <label for="horarioinscricao">Horário de fim das inscrições (ex: 16:00):</label>
                            <input type="text" class="form-control" style="width: 20%" name="horarioinscricao" value="<?php echo $horarioinscricao; ?>" required data-error="Você deve informar o horário!">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div style="padding-top: 5px">
                            <button type="submit" class="btn btn-default" >Criar Maratona</button>
                        </div>
                    </form>
                </div>
            </div>          
		</div>
		<?php echo $footer;?>
	</div>
    <script src="js/validator.min.js"></script>
</body>
</html>