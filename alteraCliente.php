<?php

include_once './conecxao.php';

if (!$conection) {
    die("Conexão Falhou" . pg_errormessage($conection));
}

if (!isset($_SESSION)) {
    session_start();
}

$iCodigo        = $_POST["codigoAltera"];
$sNome          = $_POST["nomeAltera"];
$sCpf           = $_POST["cpfAltera"];
$sLogradouro    = $_POST["logradouroAltera"];
$iNumero        = $_POST["numeroAltera"];
$sBairro        = $_POST["bairroAltera"];
$sCidade        = $_POST["cidadeAltera"];
$sCep           = $_POST["cepAltera"];
$sUf            = $_POST["ufAltera"];

$sSql = "UPDATE tbcliente SET  clinome = '{$sNome}', clicpf = '{$sCpf}', clilogradouro = '{$sLogradouro}', clinumero = {$iNumero}, clibairro = '{$sBairro}', clicidade = '{$sCidade}', clicep = '{$sCep}', cliuf = '{$sUf}' WHERE clicodigo = {$iCodigo};";
$oQuery = pg_query($conection, $sSql);
pg_execute($oQuery);

header("Location: clientes.php");