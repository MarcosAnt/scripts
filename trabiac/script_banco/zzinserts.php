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

    c) Inscrição + Kit básico (Camiseta, boné, sacola de treino e medalha participação) por 100 reais*/
	
    $insert = "INSERT INTO kits VALUES (1, 'Vip - Camiseta, sacola de treino, medalha participação e Jaqueta esportiva', 180.00)";
    $query = pg_query($dbconn, $insert);
    if(!$query)
        die('<h1 style="color: red;"> 5 Falha de comunicação com o banco!</h1>');

    $insert = "INSERT INTO kits VALUES (2, 'Plus - Camiseta, boné, sacola de treino, medalha participação e cinto de hidratação', 130.00)";
    $query = pg_query($dbconn, $insert);
    if(!$query)
        die('<h1 style="color: red;"> 5 Falha de comunicação com o banco!</h1>');

    $insert = "INSERT INTO kits VALUES (3, 'Básico - Camiseta, boné, sacola de treino e medalha participação', 100.00)";
    $query = pg_query($dbconn, $insert);
    if(!$query)
        die('<h1 style="color: red;"> 5 Falha de comunicação com o banco!</h1>');

       /* //Vip - Camiseta, sacola de treino, medalha participação e Jaqueta esportiva
       // Plus - Camiseta, boné, sacola de treino, medalha participação e cinto de hidratação
        //Básico - Camiseta, boné, sacola de treino e medalha participação
        //(idkit, descr_kit, valor_kit)
        
        */
    

    /*======INSERTS NA TABELA MODALDIADE========*/
	$insert_modalide="INSERT INTO modalidade VALUES (1, 'Categoria Geral Masculino 42KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');
	
	$insert_modalide="INSERT INTO modalidade VALUES (2, 'Categoria Geral Masculino 21KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (3, 'Categoria Geral Masculino 10KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    $insert_modalide="INSERT INTO modalidade VALUES (4, 'Categoria Geral Masculino 05KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (5, 'Categoria Geral Feminino 42KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (6, 'Categoria Geral Feminino 21KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (7, 'Categoria Geral Feminino 10KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    $insert_modalide="INSERT INTO modalidade VALUES (8, 'Categoria Geral Feminino 05KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (9, 'Categoria Masculino acima de 60 anos 42KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (10, 'Categoria Masculino acima de 60 anos 21KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (11, 'Categoria Masculino acima de 60 anos 10KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    $insert_modalide="INSERT INTO modalidade VALUES (12, 'Categoria Masculino acima de 60 anos 05KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (13, 'Categoria Feminino acima de 60 anos 42KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (14, 'Categoria Feminino acima de 60 anos 21KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (15, 'Categoria Feminino acima de 60 anos 10KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    $insert_modalide="INSERT INTO modalidade VALUES (16, 'Categoria Feminino acima de 60 anos 05KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');
    /*======FIM INSERTS NA TABELA MODALDIADE========*/


    pg_close($dbconn);
?>