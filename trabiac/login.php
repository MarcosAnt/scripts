<?php
    require "footer.php";
    require "valida_login.php";
    require "functions.php";
    
    $falha="";
    //segui a mesma logica pra inicializar as variavies, ficou imenso eu sei xD
    $passw=$email="";
    $nomecadastro=$sobrenomecadastro=$sexocadastro=$emailcadastro=$senhacadastro="";
    $senha2cadastro=$dianasccadastro=$mesnasccadastro=$anonasccadastro="";
    
    if($logado){
        header("Location: /trabiac/conta.php");
    }//se já tiver sessão aberta, estiver logado, redireciona para página da conta

    if(!$logado && $_SERVER["REQUEST_METHOD"]=="POST"){
        
        $dbconn = conectaBD();

        //o IF é pra login e o ELSE é pra cadastro
        if(($_GET["acao"])=="login"){
            if(isset($_POST["email"]) && isset($_POST["pwd"]) && $_POST["email"]!="" && $_POST["pwd"]!=""){
                    $email  = verificaCampo($_POST["email"]);
                    $pwd    = md5(verificaCampo($_POST["pwd"]));
                    $select = "SELECT email, senha_usuario, idusuario, nome_usuario FROM usuario WHERE email='$email'";

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
                        $_SESSION["idusr"]        = $result["idusuario"];
                        $_SESSION["email"]        = $result["email"];
                        $_SESSION["nome_usuario"] = $result["nome_usuario"];
                        
                        header("Location: /trabiac/conta.php");
                    }
                    else
                        $falha="true";
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><!--jQuerry-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><!--JavaScript do Bootstrap-->
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
				<div class="col-sm-4" id="login-sm4" style="height:100%;width:35%;margin: auto;float: inherit;">
					<div class="page-header" style="margin: auto">
						<h1 style="font-size: 300%;text-align: center">Já possuo conta</h1>
					</div>
                    <?php //INICIO FORMULARIO PARA LOGAR ?>
    					<form class="form-inline" data-toggle="validator" method="POST" action="login.php?acao=login">
                            <?php if($falha == "true"): ?>
                                <p class="msg_erro_login">E-mail ou senha incorretos.<br>Por favor, tente novamente.</p>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required data-error="Você deve inserir seu email!">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group" style="padding-top: 8px;">
                                <label for="pwd">Senha:</label>
                                <input type="password" class="form-control" name="pwd" value="<?php echo $passw; ?>" required data-error="Você deve inserir sua senha!">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div id="centro" style="margin: auto;padding-top: 8px;">
                                <button type="submit" class="btn btn-default" >Entrar</button>
                            </div>
    					</form>
                    <div style="padding-top: 20px;font-size: 130%">
                        <a href="cadastro.php"> Ainda não possuo conta</a>
                    </div>
                    <?php //FIM FORMULARIO PARA LOGAR ?>
				</div>
            </div>
		</div>
		<?php echo $footer;?>
	</div>
    <script src="js/validator.min.js"></script>
</body>
</html>