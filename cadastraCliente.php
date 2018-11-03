<?php

include_once './conecxao.php';

if (!$conection) {
    die("Conexão Falhou" . pg_errormessage($conection));
}

if (!isset($_SESSION)) {
    session_start();
}

$sNome          = $_POST["nome"];
$sCpf           = $_POST["cpf"];
$sLogradouro    = $_POST["logradouro"];
$iNumero        = $_POST["numero"];
$sBairro        = $_POST["bairro"];
$sCidade        = $_POST["cidade"];
$sCep           = $_POST["cep"];
$sUf            = $_POST["uf"];

$sSql = "WITH series AS (SELECT generate_series(1, (SELECT max(clicodigo)
					     FROM tbcliente)) AS mysequence)";
$sSql .= "INSERT INTO tbcliente 
          VALUES ((SELECT COALESCE((SELECT min(mysequence) 
                     FROM series
                    WHERE series.mysequence NOT IN(SELECT clicodigo 
                                                     FROM tbcliente)), 
                  (SELECT max(clicodigo) + 1 
                     FROM tbcliente), 1)), 
                 '{$sNome}', 
                 '{$sCpf}', 
                 '{$sLogradouro}', 
                  {$iNumero}, 
                 '{$sBairro}',
                 '{$sCidade}',
                 '{$sCep}',
                 '{$sUf}');";
$oQuery = pg_query($conection, $sSql);
pg_execute($oQuery);

header("Location: clientes.php");