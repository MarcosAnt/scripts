<?php
    require "footer.php";
    require "valida_login.php";
    require "functions.php";
    
    $errocadastro=false;
    $datanasccadastro="";
    $nomecadastro=$sexocadastro=$emailcadastro=$senhacadastro="";
    $senha2cadastro=$dianasccadastro=$mesnasccadastro=$anonasccadastro=""; $rgcadastro=$cpfcadastro=$passaportecadastro=$fone1cadastro=$fone2cadastro=$foneemergcadastro=$nomeemergcadastro=$parentescoemergcadastro="";
    
    if($logado){
        header("Location: /trabiac/conta.php");
    }

    if(!$logado && $_SERVER["REQUEST_METHOD"]=="POST")
    {

        $dbconn = conectaBD();
        
        if(($_GET["acao"])=="cadastro")
        {
            if(isset($_POST["nomecadastro"]) && $_POST["nomecadastro"]!="" && isset($_POST["emailcadastro"]) && $_POST["emailcadastro"]!="" && isset($_POST["senhacadastro"]) && $_POST["senhacadastro"]!="")
            {
                
                $senhacadastro  = verificaCampo($_POST["senhacadastro"]);
                $senha2cadastro = verificaCampo($_POST["senha2cadastro"]);
                
                $dianasccadastro = $_POST["dianasccadastro"];
                $mesnasccadastro = $_POST["mesnasccadastro"];
                $anonasccadastro = $_POST["anonasccadastro"];
                $sexocadastro    = $_POST["sexocadastro"];
                
                

                if(($senhacadastro==$senha2cadastro)&&($dianasccadastro!="DD")&&($mesnasccadastro!="MM")&&($anonasccadastro!="AAAA")&&($sexocadastro!="-Selecione-"))
                {

                    $nomecadastro       = verificaCampo($_POST["nomecadastro"]);
                    $senhacadastro      = md5(verificaCampo($_POST["senhacadastro"]));
                    $rgcadastro         = verificaCampo($_POST["rgcadastro"]);
                    $cpfcadastro        = verificaCampo($_POST["cpfcadastro"]);
                    $passaportecadastro = verificaCampo($_POST["passaportecadastro"]);
                    $emailcadastro      = verificaCampo($_POST["emailcadastro"]);

                    $fone1cadastro           = verificaCampo($_POST["fone1cadastro"]);
                    $fone2cadastro           = verificaCampo($_POST["fone2cadastro"]);
                    $foneemergcadastro       = verificaCampo($_POST["foneemergcadastro"]);
                    $nomeemergcadastro       = verificaCampo($_POST["nomeemergcadastro"]);
                    $parentescoemergcadastro = verificaCampo($_POST["parentescoemergcadastro"]);

                    $datanasccadastro = $anonasccadastro . "-" . $mesnasccadastro . "-" . $dianasccadastro;

                    //echo $sexocadastro;

                    $select = "SELECT email, idusuario FROM usuario WHERE email='$emailcadastro'";
                    $query = pg_query($dbconn, $select);

                    if((pg_num_rows($query) == 0))
                    {
                        $insert = "INSERT INTO usuario(nome_usuario, senha_usuario, rg, cpf, passaporte, data_nasc, sexo, email, fone_contato1, fone_contato2, fone_emergencia1, nome_contato1, parentesco_contato1) VALUES ('$nomecadastro', '$senhacadastro', '$rgcadastro', '$cpfcadastro', '$passaportecadastro', '$datanasccadastro', '$sexocadastro', '$emailcadastro', '$fone1cadastro', '$fone2cadastro', '$foneemergcadastro', '$nomeemergcadastro', '$parentescoemergcadastro')";
                        $query = pg_query($dbconn, $insert);

                        $select = "SELECT email, idusuario FROM usuario WHERE email='$emailcadastro'";
                        $query = pg_query($dbconn, $select);

                        $result=pg_fetch_assoc($query);

                        $falha="false";
                        header("Location: /trabiac/login.php");
                    }else{
                        die('<h1 class="msg_erro_login" style="color: red;">Usuário já cadastrado!</h1>');
                    }

                }else{
                    $errocadastro=true;
                }
            }else{
                $errocadastro=true;
            }
        
            pg_close($dbconn);
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
        .msg_erro_login{
            color: red;
            font-size: 7px;
            text-align: center;
            border-radius: 3px;
            border: 1px solid red;
            background-color: #fedede;
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
				<div class="col-sm-4" id="login-sm4" style="height:100%;width:55%;margin: auto;float: inherit;">
					<div class="page-header">
						<h1 style="font-size: 300%;text-align: center">Ainda não possuo conta</h1>
					</div>

                    <?php //INICIO FORMULARIO PRE-CADASTRO ?>
                        <?php if($errocadastro): ?>

                            <div class="col-sm-12 msg_erro_input_vazio">
                                <p style="margin: 0px">Preencha o cadastro corretamente!</p>
                            </div>

                        <?php endif; ?>

    					<form class="form-inline" data-toggle="validator" method="POST" action="cadastro.php?acao=cadastro">
                                <div class="form-group" style="padding-top: 5px;">
                                    <label for="nome">Nome completo:</label>
                                    <input type="text" class="form-control" name="nomecadastro" value="<?php echo $nomecadastro; ?>" required data-error="Você deve informar seu nome!">
                                    <div class="help-block with-errors"></div>
                                </div>
                            <br>
                                
                                <div class="form-group" style="padding-top: 5px;">
                                    <label for="rg" >RG:</label>
                                    <input type="text" class="form-control" name="rgcadastro" value="<?php echo $rgcadastro; ?>" required data-error="Você deve informar RG!">
                                    <div class="help-block with-errors"></div>
                                </div>
                            <br>
                            
                                <div class="form-group" style="padding-top: 5px;">
                                    <label for="cpf" >CPF:</label>
                                    <input type="text" class="form-control" name="cpfcadastro" value="<?php echo $cpfcadastro; ?>" required data-error="Você deve informar seu CPF!">
                                    <div class="help-block with-errors"></div>                                    
                                </div>
                                
                                <div class="form-group" style="padding-top: 5px;">
                                    <label for="passaporte" >Passaporte (se possuir):</label>
                                    <input type="text" class="form-control" name="passaportecadastro" value="<?php echo $passaportecadastro; ?>">
                                </div>
                                
                                <div class="form-group" style="padding-top: 5px;">
                                    <label for="email" >Email:</label>
                                    <input type="text" class="form-control" name="emailcadastro" value="<?php echo $emailcadastro; ?>" style="width: 80%" required data-error="Você deve informar seu email!">
                                    <div class="help-block with-errors"></div> 
                                </div>
                                <div>
                                    <label for="sexo">Sexo:</label>
                                    <select class="form-control" name="sexocadastro" value="<?php echo $sexocadastro; ?>">
                                        <option>-Selecione-</option>
                                        <option>Feminino</option>
                                        <option>Masculino</option>
                                    </select>
                                    <div class="help-block with-errors"></div> 
                                </div>
                                    
                                <div class="form-group" style="padding-top: 5px;">
                                    <label for="pwd">Senha:</label>
                                    <input type="password" class="form-control" name="senhacadastro" value="<?php echo $senhacadastro; ?>" required data-error="Você deve informar uma senha!">
                                    <div class="help-block with-errors"></div>  
                                </div>
                            <br>
                                <div class="form-group" style="padding-top: 5px;">
                                    <label for="confirma-pwd" style="padding-left: 8px;">Confirmar Senha:</label>
                                    <input type="password" class="form-control" name="senha2cadastro" value="<?php echo $senha2cadastro; ?>" required data-error="Senhas não correspondentes!">
                                    <div class="help-block with-errors"></div>  
                                </div>
                                
                                <div class="form-group" style="padding-top: 5px;">
                                    <label for="nome">Fone contato 1 (apenas números):</label>
                                    <input type="text" class="form-control" name="fone1cadastro" placeholder="ex.: 41 9999 9999" value="<?php echo $fone1cadastro; ?>" style="width: 40%" required data-error="Você deve informar um telefone!">
                                    <div class="help-block with-errors"></div>  
                                </div>  
                                
                                <div class="form-group" style="padding-top: 5px;">
                                    <label for="nome">Fone contato 2 (apenas números):</label>
                                    <input type="text" class="form-control" name="fone2cadastro" placeholder="ex.: 41 9999 9999" value="<?php echo $fone2cadastro; ?>" style="width: 40%" required data-error="Você deve informar um telefone!">
                                    <div class="help-block with-errors"></div>  
                                </div>
                                
                                <div class="form-group" style="padding-top: 5px;">
                                    <label for="dia">Data de nascimento:</label>
                                    <select class="form-control" name="dianasccadastro" value="<?php echo $dianasccadastro; ?>" title="DD">
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
                                    <select class="form-control" name="mesnasccadastro" value="<?php echo $mesnasccadastro; ?>" title="MM">
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
                                    <select class="form-control" name="anonasccadastro" value="<?php echo $anonasccadastro; ?>" title="AAAA">
                                        <option>AAAA</option>
                                        <option>2000</option>
                                        <option>1999</option>
                                        <option>1998</option>
                                        <option>1997</option>
                                        <option>1996</option>
                                        <option>1995</option>
                                        <option>1994</option>
                                        <option>1993</option>
                                        <option>1992</option>
                                        <option>1991</option>
                                        <option>1990</option>
                                        <option>1989</option>
                                        <option>1988</option>
                                        <option>1987</option>
                                        <option>1986</option>
                                        <option>1985</option>
                                        <option>1984</option>
                                        <option>1983</option>
                                        <option>1982</option>
                                        <option>1981</option>
                                        <option>1980</option>
                                        <option>1979</option>
                                        <option>1978</option>
                                        <option>1977</option>
                                        <option>1976</option>
                                        <option>1975</option>
                                        <option>1974</option>
                                        <option>1973</option>
                                        <option>1972</option>
                                        <option>1971</option>
                                        <option>1970</option>
                                        <option>1969</option>
                                        <option>1968</option>
                                        <option>1967</option>
                                        <option>1966</option>
                                        <option>1965</option>
                                        <option>1964</option>
                                        <option>1963</option>
                                        <option>1962</option>
                                        <option>1961</option>
                                        <option>1960</option>
                                        <option>1959</option>
                                        <option>1958</option>
                                        <option>1957</option>
                                        <option>1956</option>
                                        <option>1955</option>
                                        <option>1954</option>
                                        <option>1953</option>
                                        <option>1952</option>
                                        <option>1951</option>
                                        <option>1950</option>
                                        <option>1949</option>
                                        <option>1948</option>
                                        <option>1947</option>
                                        <option>1946</option>
                                        <option>1945</option>
                                        <option>1944</option>
                                        <option>1943</option>
                                        <option>1942</option>
                                        <option>1941</option>
                                        <option>1940</option>
                                        <option>1939</option>
                                        <option>1938</option>
                                        <option>1937</option>
                                        <option>1936</option>
                                        <option>1935</option>
                                        <option>1934</option>
                                        <option>1933</option>
                                        <option>1932</option>
                                        <option>1931</option>
                                        <option>1930</option>
                                        <option>1929</option>
                                        <option>1928</option>
                                        <option>1927</option>
                                        <option>1926</option>
                                        <option>1925</option>
                                        <option>1924</option>
                                        <option>1923</option>
                                        <option>1922</option>
                                        <option>1921</option>
                                        <option>1920</option>
                                    </select>
                                    
                                </div>
                                
                                <br>
                                <br>
                                <div class="form-group" style="padding-top: 5px;">
                                    <p>Contato de emergência</p>
                                    <label for="nome">Fone (apenas números):</label>
                                    <input type="text" class="form-control" name="foneemergcadastro" placeholder="ex.: 41 9999 9999" value="<?php echo $foneemergcadastro; ?>" style="width: 40%" required data-error="Você deve informar um telefone para emergência!">
                                    <div class="help-block with-errors"></div>  
                                </div>
                                
                                <div class="form-group" style="padding-top: 5px;">
                                    <label for="nome">Nome do contato:</label>
                                    <input type="text" class="form-control" name="nomeemergcadastro" value="<?php echo $nomeemergcadastro; ?>" style="width: 40%" required data-error="Você deve informar um nome para contato!">
                                    <div class="help-block with-errors"></div>  
                                </div>
                                
                                <div class="form-group" style="padding-top: 5px;">
                                    <label for="nome">Parentesco do contato:</label>
                                    <input type="text" class="form-control" name="parentescoemergcadastro" value="<?php echo $parentescoemergcadastro; ?>" style="width: 40%" required data-error="Você deve informar o parentesco do contato!">
                                    <div class="help-block with-errors"></div>  
                                </div>
                                
                            <br>
                                    
                            <div style="margin: auto;"> 
                                <button type="submit" class="btn btn-default" >Criar Conta</button>
                            </div>
                            
                        </form>
                    <?php //FIM FORMULARIO PRE-CADASTRO ?>
                </div>
                <div style="padding-top: 20px;font-size: 130%">
                    <a href="login.php"> Já possuo conta</a>
                </div>
            </div>
		</div>

		<?php echo $footer;?>

	</div>
    <script src="js/validator.min.js"></script>
</body>
</html>