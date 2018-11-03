<?php

include_once './conecxao.php';

if (!$conection) {
    die("Conexão Falhou" . pg_errormessage($conection));
}

if (!isset($_SESSION)) {
    session_start();
}

$sNome          = $_POST["nome"];
$sDescricao     = $_POST["descricao"];
$sFabricante    = $_POST["fabricante"];
$fPreco         = $_POST["preco"];

$sSql = "WITH series AS (SELECT generate_series(1, (SELECT max(procodigo)
					     FROM tbproduto)) AS mysequence)";
$sSql .= "INSERT INTO tbproduto 
          VALUES ((SELECT COALESCE((SELECT min(mysequence) 
                                      FROM series 
                                     WHERE series.mysequence NOT IN(SELECT procodigo 
                                                                      FROM tbproduto)), 
                                   (SELECT max(procodigo) + 1 
                                      FROM tbproduto), 1)),
                 '{$sNome}', 
                 '{$sDescricao}', 
                 '{$sFabricante}', 
                  {$fPreco});";
$oQuery = pg_query($conection, $sSql);
pg_execute($oQuery);

header("Location: produtos.php");