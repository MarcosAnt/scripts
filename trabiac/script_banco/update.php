<?php
	$strconn = "host=localhost port=5432 dbname=makerun user=postgres password=Maruve";
    $dbconn = pg_connect($strconn);
    if(!$dbconn)
        die('<h1 style="color: red;">Falha ao conectar no banco!</h1>');

	/*
	Maratona beneficente São João
	Maratona da Capela de Cuiabá
	Maratona do estado de São Paulo
	Maratona de todos os santos
	Maratona de Maceió
    
    a) Inscrição + Kit Vip (Camiseta, sacola de treino, medalha participação e Jaqueta esportiva) por 180 reais

    b) Inscrição + Kit Plus (Camiseta, boné, sacola de treino, medalha participação e cinto dehidratação) por 130 reais

    c) Inscrição + Kit básico (Camiseta, boné, sacola de treino e medalha participação) por 100 reais
	
    
    $insert="INSERT INTO forma_pgto VALUES (2, 'Boleto Bancário CAIXA')";
    $query=pg_query($dbconn, $insert);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    $insert="INSERT INTO forma_pgto VALUES (3, 'Boleto Bancário ITAÚ')";
    $query=pg_query($dbconn, $insert);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    $insert="INSERT INTO forma_pgto VALUES (4, 'Boleto Bancário BRADESCO')";
    $query=pg_query($dbconn, $insert);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    $insert="INSERT INTO forma_pgto VALUES (5, 'Boleto Bancário SANTANDER')";
    $query=pg_query($dbconn, $insert);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    /*$insert="UPDATE kits SET descr_kit='Vip - Camiseta, sacola de treino, medalha participação e Jaqueta esportiva' WHERE idkit=1";
    $query=pg_query($dbconn, $insert);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    $insert="UPDATE kits SET descr_kit='Plus - Camiseta, boné, sacola de treino, medalha participação e cinto de hidratação' WHERE idkit=2";
    $query=pg_query($dbconn, $insert);
    if(!$query)
        die('<h1 style="color: red;"> 2 Falha de comunicação com o banco!</h1>');

    $insert="UPDATE kits SET descr_kit='Básico - Camiseta, boné, sacola de treino e medalha participação' WHERE idkit=3";
    $query=pg_query($dbconn, $insert);
    if(!$query)
        die('<h1 style="color: red;"> 3 Falha de comunicação com o banco!</h1>');*/

    $update="UPDATE maratona SET nome_evento='Maratona beneficiente de São João' WHERE idmaratona=1";
    $query = pg_query($dbconn, $update);

    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    $update="UPDATE maratona SET nome_evento='Maratona da Capela de Cuiabá' WHERE idmaratona=2";
    $query = pg_query($dbconn, $update);

    if(!$query)
        die('<h1 style="color: red;"> 2 Falha de comunicação com o banco!</h1>');

    $update="UPDATE maratona SET nome_evento='Maratona do estado de São Paulo' WHERE idmaratona=3";
    $query = pg_query($dbconn, $update);

    if(!$query)
        die('<h1 style="color: red;"> 3 Falha de comunicação com o banco!</h1>');

    $update="UPDATE maratona SET nome_evento='Maratona de Todos os Santos' WHERE idmaratona=4";
    $query = pg_query($dbconn, $update);

    if(!$query)
        die('<h1 style="color: red;"> 4 Falha de comunicação com o banco!</h1>');

    $update="UPDATE maratona SET nome_evento='Maratona de Maceió' WHERE idmaratona=5";
    $query = pg_query($dbconn, $update);

    if(!$query)
        die('<h1 style="color: red;"> 5 Falha de comunicação com o banco!</h1>');

    pg_close($dbconn);
?>