<?php include "footer.php";?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Bem Vindo | MakeRun</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="img/icon.png" type="image/x-icon">
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--CSS do Bootstrap-->
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
					  <li><a href="login.php">Conta</a></li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="jumbotron">
            <div class="col-sm-6" style="float: right;">
                <img class="img-thumbnail" src="img/faq.png" alt="imagem de uma mulher correndo">
            </div>
			<h2>O que vestir?</h2>
            <p>"Procure utilizar roupas leves. Entre as diversas marcas e modelos no mercado, minha dica para estar confortável durante a atividade é escolher produtos com tecido “dry fit”, pois são mais leves e ajudam na “refrigeração” do corpo, expelindo o calor gerado durante a atividade."</p>
            <br>
            <h2>Onde treinar?</h2>
            <p>Definir local onde irá iniciar os treinos não é tão simples quanto parece, já que o terreno, a elevação e as condições gerais de temperatura no local podem influenciar na sua evolução. Se vai correr na rua, procure locais arborizados e planos – eles somam pontos positivos porque ajudam na respiração (ar mais limpo e fresco!) e na correta execução das passadas, respectivamente. Já se você vai treinar em uma academia, o local deve ser bem climatizado e dispor de equipamentos em ótimo estado. A vantagem de correr na esteira é que ela reduz o impacto nas articulações e não está sujeita às interferências do tempo.</p>
            <br>
            <h2>O que comer?</h2>
            <p>Jamais inicie o treino em jejum! A corrida é uma atividade aeróbia que consome muita energia, portanto, para evitar fraqueza causada pela queda brusca da glicemia (nível de açúcar no sangue) ou até da pressão cardíaca, alimente-se adequadamente antes de cair na pista. Para montar um cardápio certeiro, o indicado é procurar um profissional especializado (um nutricionista, nutrólogo, médico do esporte…), mas a dica geral é comer alimentos que contenham carboidratos de fácil digestão (até meia hora antes do treino) e não se esquecer de começar a correr bem hidratada.</p>
            <br>
            <h2>O que calçar?</h2>
            <p>Os tênis são o equipamento principal. Procure calçados específicos para corrida. Fique com um para pisada neutra (se ainda não fez um teste de pisada) ou procure lojas especializadas para avaliar o seu tipo. Após percorrer de 500 a 600 km (isso vai demorar!), é indicado que o tênis seja substituído, mesmo que ele ainda esteja em boa aparência – seu corpo agradece.</p>
            <br>
            <h2>Correr com casaco ajuda a emagrecer?</h2>
            <p>Isso pode até fazer com que os ponteiros da balança baixem um pouco, mas não por que você está mais magro e sim por que eliminou água. Você está literalmente secando, não emagrecendo. Ao induzir o excesso de transpiração, colocando mais casacos, você corre o risco de ficar desidratado e comprometer o seu treino. Emagrecer é queimar gordura, e correr com uma roupa adequada e confortável é uma ótima forma de fazer isso.</p>
            <br>
            <h2>Correr na rua é mais difícil do que correr na esteira?</h2>
            <p>Talvez um pouco mais quando estamos começando no esporte. O fato de na esteira você poder controlar rigorosamente a sua velocidade pode ser o suficiente para não ultrapassar sua zona de cansaço. E como na rua, às vezes, não temos esse recurso eletrônico, passamos um pouco do ponto e entramos em um ritmo mais acelerado antes do tempo, podendo comprometer a corrida. Isso pode dar a impressão da corrida ser mais difícil na rua, mas à medida que você vai melhorando (e praticando na rua), vai aprendendo a dosar e imprimir as suas velocidades com mais eficiência.</p>
            <br>
            <h2>Treinar de manhã é melhor?</h2>
            <p>A melhor hora para treinar é a hora em que você pode fazer o treino direito. Pode ser de manhã, à tarde ou à noite. Seu corpo se adapta as condições da sua vida. O mais importante é estar bem alimentado e pronto para o que virá naquele dia. Entretanto, se você tem uma vida agitada e os compromissos aparecem de uma hora para a outra, talvez treinar logo de manhã seja mais interessante, simplesmente pelo fato de minimizar as chances de você acabar não treinando por causa de um desses compromissos.</p>
            <br>
            <h2>Grávidas podem correr?</h2>
            <p>Sim, correr durante a gravidez pode trazer muitos benefícios para a mãe, desde que o médico libere a gestante para a prática da atividade. No geral, quem ainda não corre não deve começar nesse período, mas as corredoras têm boas chances de receber sinal verde para continuar treinando. Entretanto, nessa situação, o treino vira uma atividade leve e relaxante.</p>
            <br>
            <h2>Se não malhar, vai se machucar?</h2>
            <p>Não necessariamente. Você pode ser um corredor (dos bons) e não malhar. O que machuca os corredores, na maioria das vezes, é treinar demais. Talvez a musculação o deixe mais forte e resistente, possibilitando metas mais ambiciosas, mas respeitar os limites do corpo é a melhor forma de não se machucar.</p>
            <br>
            <br><p style="font-size: 120%">
                Fontes:
                <a href="http://www.suacorrida.com.br/treino-wrun/4-duvidas-de-todo-iniciante-na-corrida/">
                    http://www.suacorrida.com.br/treino-wrun/4-duvidas-de-todo-iniciante-na-corrida/ </a>
                <br>
                <a href="http://globoesporte.globo.com/eu-atleta/treinos/noticia/2014/03/duvidas-comuns-sobre-corrida-para-auxiliar-quem-esta-comecando.html">
                    http://globoesporte.globo.com/eu-atleta/treinos/noticia/2014/03/duvidas-comuns-sobre-corrida-para-auxiliar-quem-esta-comecando.html </a>
                </p>
		</div>
		<?php echo $footer;?>
	</div>    
</body>
</html>