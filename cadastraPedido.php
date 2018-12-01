<?php

include_once './conecxao.php';

if (!$conection) {
    die("Conexão Falhou" . pg_errormessage($conection));
}

if (!isset($_SESSION)) {
    session_start();
}

$fCodigoCliente  = $_POST["codigoCliente"];
$fValorTotal     = $_POST["valorTotal"];
$aProdutos       = $_POST["idProduto"];
$aQtdeProdutos   = $_POST["qtdProduto"];
$aDsctoProdutos  = $_POST["desconto"];

$sSqlCodProd = "WITH series AS (SELECT generate_series(1, (SELECT max(pedcodigo)
					     FROM tbpedido)) AS mysequence)";

$sSqlCodProd .= "SELECT COALESCE((SELECT min(mysequence)
                     FROM series
                    WHERE series.mysequence NOT IN(SELECT pedcodigo
                                                     FROM tbpedido)),
                  (SELECT max(pedcodigo) + 1
                     FROM tbpedido), 1)";

$oQueryCodProd = pg_query($conection, $sSqlCodProd);
$iCodigoPedido = pg_fetch_row($oQueryCodProd)[0];

$sSql = "INSERT INTO tbpedido
          VALUES ({$iCodigoPedido},
                  {$fCodigoCliente},
                  'NOW()',
                  {$fValorTotal});";


$oQuery = pg_query($conection, $sSql);
pg_execute($oQuery);

foreach ($aProdutos as $key => $iCodigoProduto){
    if(isset($aDsctoProdutos[$key]) && $aDsctoProdutos[$key] != ''){
        $fDescAtual = $aDsctoProdutos[$key];
    } else {
        $fDescAtual = 0;
    }
    $sSqlProdPed = "INSERT INTO tbpedidoproduto VALUES ( 
                     {$iCodigoPedido},
                     {$iCodigoProduto},
                     {$aQtdeProdutos[$key]},
                     $fDescAtual)";
    $oQueryProd = pg_query($conection, $sSqlProdPed);
    pg_execute($oQueryProd);
}

header("Location: pedidos.php");