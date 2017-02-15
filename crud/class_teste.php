<?php
	require_once ("classes/bd_class.php");

	$objetoDeBanco = new conectaBanco();

	$objetoDeBanco->query();

	echo $objetoDeBanco->query_return;

?>