<?php
	require "footer.php";
	require "valida_login.php";
	require "functions.php";

    $dbconn = conectaBD();

    $select = "SELECT * FROM usuario WHERE idusuario=" . $_SESSION["idusr"];

    $query = pg_query($dbconn, $select);

    if(!$query)
        die('<h1 style="color: red;">Falha de comunicação com o banco!</h1>');
    else{
        if(pg_num_rows($query) != 1)
            die('<h1 style="color: red;">Problema com informações de cadastro</h1>');

        $result=pg_fetch_assoc($query);
    }
    pg_close($dbconn);
?>

<?php //if($logado==true): ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Perfil | MakeRun</title>
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
					  <li><a href="calendario.php">Calendário</a></li>
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
                
				<div class="col-sm-10">
					<?php if( $_SERVER["REQUEST_METHOD"]=="POST" ): ?>
						<div class="form-group">
							<label class="control-label col-sm-2" for="nome">Nome:</label>
							<div class="col-sm-6">
							<p>Nome: </p><?php echo $result["nome_usuario"]; ?>
							<?php //echo '<input type="text" class="form-control" id="nome" placeholder="Nome" value="' . $result["pnome"] .' '. $result["mnome"] .' '. $result["unome"] . '"' ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="data_nasc">Data Nascimento:</label>
							<div class="col-sm-6">
								<?php echo '<input type="text" class="form-control" id="data_nasc" placeholder="Data de Nacsimento" value="' . $result["data_nasc"] . '">'; ?>
				            </div>
				        </div>
                </div>
							<div class="form-group">
							<label class="control-label col-sm-2" for="rg">RG:</label>
							<div class="col-sm-4">
							<?php //echo '<input type="text" class="form-control" id="rg" placeholder="RG" value="' . $result["rg"] .'">'?>
							</div>
							<label class="control-label col-sm-2" for="cpf">CPF:</label>
							<div class="col-sm-4">
							<?php //echo '<input type="text" class="form-control" id="cpf" placeholder="CPF" value="'. $result["cpf"] . '">'?>
							</div>
						</div>
					<?php elseif(isset($_GET["opc"]) && $_GET["opc"]=="inscr"): ?>
						<?php

							$dbconn = conectaBD();

							$select_aux="SELECT idmaratona FROM usuario_maratona WHERE idusuario=" . $_SESSION["idusr"]; 
							$query_aux = pg_query($dbconn, $select_aux);
						    if(!$query_aux)
						        die('<h1 style="color: red;">Falha de comunicação com o banco!</h1>');
						    else
						        $result_aux=pg_fetch_assoc($query_aux);

						    if(pg_num_rows($query_aux)!=0){
								$select="SELECT * FROM maratona WHERE idmaratona=" . $result_aux["idmaratona"];
								$query = pg_query($dbconn, $select);
							    if(!$query)
							        die('<h1 style="color: red;">Falha de comunicação com o banco!</h1>');
							}else
								echo '<p> Sem maratonas no momento :c </p>';

							pg_close($dbconn);
						?>

						<div>
	                    <?php if(pg_num_rows($query) == 0): ?>
	                        <p> Sem maratonas no momento :c </p>
	                        <?php else: ?>
	                            <?php while($maratona = pg_fetch_assoc($query)): ?>
	                                <div>
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
	                                                        <?php echo strtoupper($maratona["nome_evento"]); ?>
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
	                                            <a href="descr_ev_private.php?idevt=<?php echo $maratona["idmaratona"]; ?>&idusr<?php echo $_SESSION["idusr"]?>"
	                                               class="btn btn-link btn-sm" role="button">+ Saiba Mais</a>
	                                        </div>
	                                    </div>
	                                </div>
	                            <?php endWhile; ?>
	                        <?php endIf; ?>                  
	                	</div>

					<?php elseif(isset($_GET["opc"]) && $_GET["opc"]=="ests"): ?>
						<?php
						
							$dbconn = conectaBD();

							$select_aux="SELECT *, hora_termino - hora_inicio AS tempo_prova FROM usuario_maratona WHERE idusuario={$_SESSION["idusr"]} AND hora_termino!=hora_inicio ORDER BY idmaratona"; 
							$query_aux = pg_query($dbconn, $select_aux);
						    if(!$query_aux)
						        die('<h1 style="color: red;">Falha de comunicação com o banco!</h1>');
						    
					    
							if(pg_num_rows($query_aux)==0){
								pg_close($dbconn);
								echo ' 
									<div class="panel panel-default">
									<div class="panel-body">
										<p style="margin: 10px">Você ainda não particiou de nenhuma maratona. Quando participar volte aqui e acompanhe seu desempanho</p>
									</div>
									</div>';
							}else{
							    echo '
							    <div class="panel panel-default"
								<div class="panel-body">
								<table class="table">
									<thead>
										<tr>
											<th>Maratona</th>
											<th>Nº Inscrição</th>
											<th>Tempo de Prova</th>
											<th>Data</th>
										</tr>
									</thead>
									<tbody>';
																									    
									$select="SELECT idmaratona, nome_evento, datahora FROM maratona ORDER BY idmaratona";
									$query = pg_query($dbconn, $select);
								    if(!$query)
								        die('<h1 style="color: red;">Falha de comunicação com o banco!</h1>');

								    pg_close($dbconn);

								while($result_aux=pg_fetch_assoc($query_aux)){

									$maratona = pg_fetch_assoc($query);
									if( $result_aux["idmaratona"] == $maratona["idmaratona"] ){
						        		$string = $maratona ["datahora"];
										echo"
									      <tr>
									        <td>{$maratona["nome_evento"]}</td>
									        <td>{$result_aux["idinscr"]}</td>
									        <td>{$result_aux["tempo_prova"]}</td>
									        <td>{$string[8]}{$string[9]}/{$string[5]}{$string[6]}</td>
									      </tr>";
									}
								}
								echo '</tbody>
								</table>
								</div>

								</div>';
							}
						?>
					<?php elseif(isset($_GET["opc"]) && $_GET["opc"]=="myevent"): ?>
					<?php else: ?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<p>Infromações Cadastrais</p>
							</div>
							<div class="panel-body">
								 <form method="POST" action="conta.php">
									<div class="form-group">
										<p>Informações Pessoais</p>
										Nome: <?php echo $result["nome_usuario"]; ?><br>
										Data de Nascimento: <?php echo $result["data_nasc"]; ?><br>
                                        Sexo: <?php echo $result["sexo"]; ?><br>
										RG: <?php echo $result["rg"]; ?><br>
										CPF: <?php echo $result["cpf"]; ?><br>
                                        Passaporte: 
                                        <?php if($result["passaporte"]==""){
                                                echo "Não possui.";
                                            }else{
                                                echo $result["passaporte"];
                                            }?><br>
										E-mail: <?php echo $result["email"]?><br>
                                        
										<p>Inofrmações para Contato</p>
										Primeiro Tel. Contato: <?php echo $result["fone_contato1"]?><br>
										Segundo Tel. Contato: <?php echo $result["fone_contato2"]?><br>
										Primeiro Tel. Emergência: <?php echo $result["fone_emergencia1"]?><br>
										Nome do Primeiro Contato: <?php echo $result["nome_contato1"]?><br>
										Parentesco: <?php echo $result["parentesco_contato1"]?><br>
									</div>
									<!--button type="submit" class="btn btn-default" >Editar Informações</button-->
								</form>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php echo $footer;?>
    </div>
</body>
</html>
<?php //endif; ?>



