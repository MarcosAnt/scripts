<?php
$conteudo = "<h1>TestE</h1>";	
$id="PrimeiraMaratonaTeste";
$id.='.php';
// Criando o novo arquivo
echo file_put_contents($id, $conteudo); // Resultado: 26
?>