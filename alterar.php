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
$sDescricao     = $_POST["descricaoAltera"];
$sFabricante    = $_POST["fabricanteAltera"];
$fPreco         = $_POST["precoAltera"];
$sSql = "UPDATE tbproduto SET  pronome = '{$sNome}', prodescricao = '{$sDescricao}', profabricante = '{$sFabricante}', provalor = {$fPreco} WHERE procodigo = {$iCodigo};";
$oQuery = pg_query($conection, $sSql);
pg_execute($oQuery);

header("Location: produtos.php?alert=1");