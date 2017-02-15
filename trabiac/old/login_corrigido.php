<?php
    require "footer.php";
    require "valida_login.php";
    
    $falha="";
    $input_vazio=false;
    //segui a mesma logica pra inicializar as variavies, ficou imenso eu sei xD
    $passw=$email="";
    $nomecadastro=$sobrenomecadastro=$sexocadastro=$emailcadastro=$senhacadastro="";
    $senha2cadastro=$dianasccadastro=$mesnasccadastro=$anonasccadastro="";
    
    if($logado){
        header("Location: /trabiac/conta.php");
    }

    if(!$logado && $_SERVER["REQUEST_METHOD"]=="POST"){
        $strconn = "host=localhost port=5432 dbname=makerun user=postgres password=Maruve";
        $dbconn = pg_connect($strconn);
        if(!$dbconn)
            die('<h1 style="color: red;">Falha ao conectar no banco!</h1>');
        //o IF é pra login e o ELSE é pra cadastro
        if(($_GET["acao"])=="login"){
            if(isset($_POST["email"]) && isset($_POST["pwd"]) && $_POST["email"]!="" && $_POST["pwd"]!=""){
                    $email = pg_escape_string($_POST["email"]);
                    $pwd = md5(pg_escape_string($_POST["pwd"]));
                    $select = "SELECT email, senha_usuario, idusuario, pnome FROM usuario WHERE email='$email'";

                    $query = pg_query($dbconn, $select);

                    if(!$query)
                        die('<h1 style="color: red;">Falha de comunicação com o banco!</h1>');
                    else
                        if(pg_num_rows($query) != 1){
                            die('<h1 style="color: red;">Problema com informações de cadastro</h1>');
                        }
                    
                    $result=pg_fetch_assoc($query);

                    if($pwd == $result["senha_usuario"]){
                        $falha="false";
                        $_SESSION["idusr"]=$result["idusuario"];
                        $_SESSION["email"]=$result["email"];
                        $_SESSION["nome_usuario"]=$result["pnome"];
                        header("Location: /trabiac/conta.php");
                    }
                    else
                        $falha="true";
            }else{
                $input_vazio=true;
            }
        }else{
            if(($_GET["acao"])=="cadastro"){
                if(isset($_POST["nomecadastro"]) && $_POST["nomecadastro"]!="" && isset($_POST["emailcadastro"]) && $_POST["emailcadastro"]!="" && isset($_POST["senhacadastro"]) && $_POST["senhacadastro"]!=""){
                    $nomecadastro = pg_escape_string($_POST["nomecadastro"]);
                    $sobrenomecadastro = pg_escape_string($_POST["sobrenomecadastro"]);
                    //$sexocadastro = $_POST["sexocadastro"];
                    $emailcadastro = pg_escape_string($_POST["emailcadastro"]);
                    $senhacadastro = md5(pg_escape_string($_POST["senhacadastro"]));
                    //$dianasccadastro = $_POST["dianasccadastro"];
                    //$mesnasccadastro = $_POST["mesnasccadastro"];
                    //$anonasccadastro = $_POST["anonasccadastro"];

                    $select = "SELECT email, idusuario FROM usuario WHERE email='$emailcadastro'";
                    $query = pg_query($dbconn, $select);

                    if((pg_num_rows($query) == 0)){
                        $insert = "INSERT INTO usuario(pnome, mnome, email, senha_usuario) VALUES ('$nomecadastro', '$sobrenomecadastro', '$emailcadastro', '$senhacadastro')";
                        $query = pg_query($dbconn, $insert);
                        //die('<h1 style="color: green;">Usuário cadastrado com sucesso!</h1>');
                        
                        $select = "SELECT email, idusuario FROM usuario WHERE email='$emailcadastro'";
                        $query = pg_query($dbconn, $select);
                        
                        $result=pg_fetch_assoc($query);
                        
                        $falha="false";
                        $_SESSION["idusr"]=$result["idusuario"];
                        $_SESSION["email"]=$result["email"];
                        header("Location: /makerun/conta.php");
                    }else{
                        die('<h1 class="msg_erro_login" style="color: red;">Usuário já cadastrado!</h1>');
                    }
                }else{
                    $input_vazio=true;
                }
            }
        }
        pg_close($dbconn);
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
			<div class="row">
                <?php if($input_vazio): ?>
                    <div class="col-sm-12 msg_erro_input_vazio">
                        <p style="margin: 0px">Preencha todos os campos!!</p>
                    </div>
                <?php endif; ?>
				<div class="col-sm-4" id="login-sm4" style="float:left;height:100%;width:35%;margin-left: 20px">
					<div class="page-header">
						<h1 style="font-size: 300%;text-align: center">Já possuo conta</h1>
					</div>
                    <?php //INICIO FORMULARIO PARA LOGAR ?>
    					<form class="form-inline" method="POST" action="login.php?acao=login">
                            <?php if($falha == "true"): ?>
                                <p class="msg_erro_login">E-mail ou senha incorretos.<br>Por favor, tente novamente.</p>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                            </div>
                            <div class="form-group" style="padding-top: 8px;">
                                <label for="pwd">Senha:</label>
                                <input type="password" class="form-control" name="pwd" value="<?php echo $passw; ?>">
                            </div>
                            <div id="centro" style="padding-left: 110px;padding-top: 8px;">
                                <button type="submit" class="btn btn-default" >Entrar</button>
                            </div>
    					</form>
                    <?php //FIM FORMULARIO PARA LOGAR ?>
				</div>
				<div class="col-sm-6" id="login-sm6" style="float:right;height:100%;width:55%;margin-right: 10px">
					<div class="page-header">
						<h1 style="font-size: 300%;text-align: center">Ainda não possuo conta</h1>
					</div>
                    <?php //INICIO FORMULARIO PRE-CADASTRO ?>
    					<form class="form-inline" method="POST" action="login.php?acao=cadastro">
    						<div class="form-group">
    							<label for="nome">Nome:</label>
    							<input type="text" class="form-control" name="nomecadastro" value="<?php echo $nomecadastro; ?>">
    							<label for="sobrenome" style="padding-left: 8px;">Sobrenome:</label>
    							<input type="text" class="form-control" name="sobrenomecadastro" value="<?php echo $sobrenomecadastro; ?>">
    						</div>
                            
    						<div class="form-group" style="padding-top: 8px;">
    							<label for="sexo">Sexo:</label>
    							<select class="form-control" name="sexocadastro" value="<?php echo $sexocadastro; ?>">
    								<option>-Selecione-</option>
    								<option>Feminino</option>
    								<option>Masculino</option>
    							</select>
    							<label for="email" style="padding-left: 8px;" >E-mail:</label>
    							<input type="email" class="form-control" name="emailcadastro" value="<?php echo $emailcadastro; ?>">
    						</div>
    						<div class="form-group" style="padding-top: 8px;">
    							<label for="pwd">Senha:</label>
    							<input type="password" class="form-control" name="senhacadastro" value="<?php echo $senhacadastro; ?>" style="width: 30%;">
    							<label for="confirma-pwd" style="padding-left: 8px;">Confirmar Senha:</label>
    							<input type="password" class="form-control" name="senha2cadastro" value="<?php echo $senha2cadastro; ?>" style="width: 30%;">
    						</div>
                            
    						<div class="form-group" style="padding-left: 70px;">
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
                                    <option>Jan</option>
                                    <option>Fev</option>
                                    <option>Mar</option>
                                    <option>Abr</option>
                                    <option>Mai</option>
                                    <option>Jun</option>
                                    <option>Jul</option>
                                    <option>Ago</option>
                                    <option>Set</option>
                                    <option>Out</option>
                                    <option>Nov</option>
                                    <option>Dez</option>
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
                            <div style="padding-left: 210px;padding-top: 8px;"> 
                                <button type="submit" class="btn btn-default" >Criar Conta</button>
                            </div>
                        </form>
                    <?php //FIM FORMULARIO PRE-CADASTRO ?>
                </div>
            </div>
		</div>
		<?php echo $footer;?>
	</div>
</body>
</html>