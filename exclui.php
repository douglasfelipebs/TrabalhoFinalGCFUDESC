<?php

include_once './conecxao.php';

if (!$conection) {
    die("Conexão Falhou" . pg_errormessage($conection));
}

if (!isset($_SESSION)) {
    session_start();
}
$tipo = $_GET['tipo'];
$id = $_GET["id"];
switch ($tipo) {
    case 'pro':
        $sSql = "DELETE FROM tbproduto WHERE procodigo = {$id}";
        $sLocation = "Location: produtos.php";
        break;
    case 'cli':
        $sSql = "DELETE FROM tbcliente WHERE clicodigo = {$id}";
        $sLocation = "Location: clientes.php";
        break;
    default:
        break;
}
if(!empty($sSql)){
    $oQuery = pg_query($conection, $sSql);
    pg_execute($oQuery);
    header($sLocation);
}