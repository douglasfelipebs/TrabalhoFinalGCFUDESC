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
        $sSql = "SELECT clinome FROM tbcliente WHERE clicodigo = {$codigo}";
        $oQuery = pg_query($conection, $sSql);
        $sNome = "";
        while ($oCliente = pg_fetch_row($oQuery)) {
            $sNome = $oCliente[0];
        }
        echo $sNome;
    }
}
?>