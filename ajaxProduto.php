<?php
ob_start();

imprime();

$resultado = ob_get_contents();

ob_end_clean();

echo $resultado;

function imprime()
{
    include_once 'conecxao.php';
    if (!$conection) {
        die("Conexão Falhou" . pg_errormessage($conection));
    }
    if (isset($_GET['codigo'])) {
        $codigo = $_GET['codigo'];
        $sSql = "SELECT pronome, provalor FROM tbproduto WHERE procodigo = {$codigo}";
        $oQuery = pg_query($conection, $sSql);
        $aProd = [];
        while ($oProduto = pg_fetch_row($oQuery)) {
            $aProd['nome'] = $oProduto[0];
            $aProd['preco'] = $oProduto[1];
        }
        echo json_encode($aProd);
    }
}
?>