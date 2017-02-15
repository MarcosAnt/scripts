<?php
	$strconn = "host=localhost port=5432 dbname=makerun user=postgres password=Maruve";
    $dbconn = pg_connect($strconn);
    if(!$dbconn)
        die('<h1 style="color: red;">Falha ao conectar no banco!</h1>');


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

	$insert_modalide="INSERT INTO modalidade VALUES (4, 'Categoria Geral Femenino 42KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (5, 'Categoria Geral Femenino 21KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (6, 'Categoria Geral Femenino 10KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (7, 'Categoria Masculino acima de 60 anos 42KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (8, 'Categoria Masculino acima de 60 anos 21KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (9, 'Categoria Masculino acima de 60 anos 10KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (10, 'Categoria Femenino acima de 60 anos 42KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (11, 'Categoria Femenino acima de 60 anos 21KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	$insert_modalide="INSERT INTO modalidade VALUES (12, 'Categoria Femenino acima de 60 anos 10KM')";
	$query=pg_query($dbconn, $insert_modalide);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');
    /*======FIM INSERTS NA TABELA MODALDIADE========*/

	/*======INSERTS NA TABELA FORMA_PGTO========*/
	$insert="INSERT INTO forma_pgto VALUES (1, 'Em dinheiro na data e loval da prova')";
    $query=pg_query($dbconn, $insert);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

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
    /*======FIM INSERTS NA TABELA FORMA_PGTO========*/
	
	/*========ALTERA TABELA DO USUARIO==============*/
	$alter="ALTER TABLE usuario DROP COLUMN pnome";
	$query=pg_query($dbconn, $alter);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    $alter="ALTER TABLE usuario DROP COLUMN mnome";
	$query=pg_query($dbconn, $alter);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    $alter="ALTER TABLE usuario DROP COLUMN unome";
	$query=pg_query($dbconn, $alter);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

    $alter="ALTER TABLE usuario ADD COLUMN sexo character";
	$query=pg_query($dbconn, $alter);
    if(!$query)
        die('<h1 style="color: red;"> 1 Falha de comunicação com o banco!</h1>');

	/*========ALTERA TABELA DO USUARIO==============*/

	pg_close($dbconn);

?>