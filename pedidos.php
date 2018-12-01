<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Pedidos - J & R Informática</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <script src="jquery-3.3.1.min.js" type="text/javascript"></script>

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <?php
    include_once './conecxao.php';
    session_start();
    $_SESSION['page'] = 4;
    $sItemAtivo = 'Pedido';
    $sSql = "SELECT pedcodigo, clicodigo || ' - ' || clinome AS cliente, peddatahora, pedvalortotal FROM tbpedido NATURAL INNER JOIN tbcliente ORDER BY pedcodigo";
    include_once './sidebar.php';
    ?>

    <div class="main-panel">
        <?php include_once './navigation.php'; ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <style>
                                .title-add {
                                    display: flex;
                                    justify-content: space-between;
                                }
                            </style>
                            <div class="header title-add">
                                <h4 class="title"><?php echo $sItemAtivo ?></h4>
                                <button class="btn" type="button" data-toggle="modal" data-target="#ModalAddPedido"><i
                                        class="fa fa-plus"></i></button>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                    <?php
                                    echo '<th>Código</th>';
                                    echo '<th>Cliente</th>';
                                    echo '<th>Data/Hora</th>';
                                    echo '<th>Valor Total</th>';
                                    echo '<th>Alterar</th>';
                                    echo '<th>Excluir</th>';
                                    ?>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $oQuery = pg_query($conection, $sSql);
                                    $iCodigo = 0;
                                    while ($aItem = pg_fetch_row($oQuery)) {
                                        echo '<tr>';
                                        foreach ($aItem as $key => $value) {
                                            if ($key == 0) {
                                                $iCodigo = $value;
                                            }
                                            echo '<td> <label id=' . $key . $iCodigo . '>' . $value . '</label></td>';
                                        }
                                        echo '<td><button class="btn" onclick="alterarItem(' . $iCodigo . ')" type="button" data-toggle="modal" data-target="#ModalAltPedido"><i class="fa fa-edit"></i></button></td>';
                                        echo '<td><button class="btn" onclick="exclui(' . $iCodigo . ')"><i class="fa fa-trash"></i></button></td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                    <script>
                                        function exclui(id) {
                                            window.location = 'exclui.php?id=' + id + '&tipo=ped';
                                        }

                                        function alterarItem(id) {
                                            var oCodigo = document.getElementById('codigoAltera');
                                            var oNome = document.getElementById('nomeAltera');
                                            var oDescricao = document.getElementById('descricaoAltera');
                                            var oFabricante = document.getElementById('fabricanteAltera');
                                            var oPreco = document.getElementById('precoAltera');

                                            var iCodigoAtual = document.getElementById('0' + id).textContent;
                                            var sNomeAtual = document.getElementById('1' + id).textContent;
                                            var sDescricaoAtual = document.getElementById('2' + id).textContent;
                                            var sFabricanteAtual = document.getElementById('3' + id).textContent;
                                            var fPrecoAtual = document.getElementById('4' + id).textContent;

                                            $(oCodigo).val(iCodigoAtual);
                                            $(oNome).val(sNomeAtual);
                                            $(oDescricao).val(sDescricaoAtual);
                                            $(oFabricante).val(sFabricanteAtual);
                                            $(oPreco).val(fPrecoAtual);
                                        }
                                    </script>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" data-backdrop="false" id="ModalAddPedido" tabindex="-1" role="dialog"
             aria-labelledby="TituloModalCentralizado" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-items">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TituloModalCentralizado">Cadastro de <?php echo $sItemAtivo ?>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <form name="cadastro" id="cadastro" action="cadastraPedido.php" method="POST">
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label for="codigoCliente" class="ffl-label">Cliente</label>
                                    <input type="number" required class="form-control border-input" id="codigoCliente" oninput="getCliente()" name="codigoCliente">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>Nome do Cliente</label>
                                    <input type="text" required readonly class="form-control border-input" id="nomeCliente" name="nomeCliente">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>Valor Total</label>
                                    <input type="number" required readonly class="form-control border-input" id="valorTotal" name="valorTotal">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10 col-lg-offset-1 form-group">
                                    <div class="row">
                                        <fieldset>
                                            <legend>Produtos</legend>
                                            <button type="button" id="add_field" class="btn btn-default">Adicionar</button>
                                            <br>
                                            <br>
                                            <div id="listas">
                                                <div class="form-group itemProd">
                                                    <label>Produto: </label>
                                                    <input type="number" required id="idProduto0" oninput="getProduto(this.id)" name="idProduto[0]" class="form-control border-input">
                                                    <label>Nome do Produto: </label>
                                                    <input type="text" required readonly id="nomeProduto0" name="nomeProduto[0]" class="form-control border-input">
                                                    <label>Quantidade: </label>
                                                    <input type="text" required oninput="alteraValorTotal()" id="qtdProduto0" name="qtdProduto[0]" class="form-control border-input">
                                                    <label>Preço: </label>
                                                    <input type="number" required readonly id="precoProduto0" name="preco[0]" class="form-control border-input">
                                                    <label>Desconto: </label>
                                                    <input type="text" oninput="alteraValorTotal()" name="desconto[0]" id="desconto0" class="form-control border-input">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" form="cadastro" class="btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" data-backdrop="false" id="ModalAltPedido" tabindex="-1" role="dialog"
         aria-labelledby="TituloModalCentralizado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-items">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCentralizado">Alterar <?php echo $sItemAtivo ?>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <div class="modal-body">
                    <form name="cadastro" id="cadastro" action="cadastraPedido.php" method="POST">
                        <div class="row">
                            <div class="col-lg-2 form-group">
                                <label for="codigoCliente" class="ffl-label">Cliente</label>
                                <input type="number" required class="form-control border-input" id="codigoCliente" oninput="getCliente()" name="codigoCliente">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Nome do Cliente</label>
                                <input type="text" required readonly class="form-control border-input" id="nomeCliente" name="nomeCliente">
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>Valor Total</label>
                                <input type="number" required readonly class="form-control border-input" id="valorTotal" name="valorTotal">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1 form-group">
                                <div class="row">
                                    <fieldset>
                                        <legend>Produtos</legend>
                                        <button type="button" id="add_field" class="btn btn-default">Adicionar</button>
                                        <br>
                                        <br>
                                        <div id="listas">
                                            <div class="form-group itemProd">
                                                <label>Produto: </label>
                                                <input type="number" required id="idProduto0" oninput="getProduto(this.id)" name="idProduto[0]" class="form-control border-input">
                                                <label>Nome do Produto: </label>
                                                <input type="text" required readonly id="nomeProduto0" name="nomeProduto[0]" class="form-control border-input">
                                                <label>Quantidade: </label>
                                                <input type="text" required oninput="alteraValorTotal()" id="qtdProduto0" name="qtdProduto[0]" class="form-control border-input">
                                                <label>Preço: </label>
                                                <input type="number" required onchange="alteraValorTotal()" readonly id="precoProduto0" name="preco[0]" class="form-control border-input">
                                                <label>Desconto: </label>
                                                <input type="text" oninput="alteraValorTotal()" name="desconto[0]" id="desconto0" class="form-control border-input">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="cadastro" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
    <style>
        input[type='number'] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>
</div>
</div>
</body>

<script>
    $(document).ready(function () {
        var campos_max = 9;         //Máximo de 9 campos
        var x = 1;                  //2º campo - O primeiro está no HTML
        $('#add_field').click(function (e) {
            e.preventDefault();     //Prevenir novos clicks
            if (x < campos_max) {
                $('#listas').append(  '<div class="form-group itemProd">'
                                    + '     <label>Produto: </label>'
                                    + '     <input type="number" required id="idProduto'+ x +'" oninput="getProduto(this.id)" name="idProduto[' + x + ']" class="form-control border-input">'
                                    + '     <label>Nome do Produto: </label>'
                                    + '     <input type="text" required readonly id="nomeProduto'+ x +'" name="nomeProduto[' + x + ']" class="form-control border-input">'
                                    + '     <label>Quantidade: </label>'
                                    + '     <input type="text" required  oninput="alteraValorTotal()" id="qtdProduto0" name="qtdProduto['+ x +']" class="form-control border-input">'
                                    + '     <label>Preço: </label>'
                                    + '     <input type="number" onchange="alteraValorTotal()" readonly id="precoProduto'+ x +'" name="preco[' + x + ']" class="form-control border-input">'
                                    + '     <label>Desconto: </label>'
                                    + '     <input type="text"  oninput="alteraValorTotal()" name="desconto[' + x + ']" id="desconto' + x + '" class="form-control border-input">'
                                    + '<br><button type="button" class="remover_campo btn btn-default">Remover</button>'
                                    + '</div>');
                x++;
            }
        });

        // Remover o div anterior
        $('#listas').on("click", ".remover_campo", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    });

    function getCliente() {
        if($('#codigoCliente').val() == ""){
            $('#nomeCliente').val("");
        } else {
            $.ajax({
                url: "ajaxCliente.php",
                method: "get",
                data: {codigo: jQuery('#codigoCliente').val()},
                dataType: "HTML",
                success: function (resultado) {
                    if(resultado != ""){
                        $('#nomeCliente').empty();
                        $('#nomeCliente').val(resultado);
                    } else {
                        $('#nomeCliente').val("");
                    }
                }
            });
        }
    }

    function getProduto(id) {
        let numId = id.replace(/\D/g, "");
        if($("#" + id).val() == ""){
            $('#nomeProduto' + numId + '').val("");
            $('#precoProduto' + numId + '').val("");
        } else {
            $.ajax({
                url: "ajaxProduto.php",
                method: "get",
                data: {codigo: jQuery('#' + id).val()},
                dataType: "json",
                success: function (resultado) {
                    if(resultado.length != {}){
                        $('#nomeProduto' + numId + '').empty();
                        $('#nomeProduto' + numId + '').val(resultado.nome);
                        $('#precoProduto' + numId + '').empty();
                        $('#precoProduto' + numId + '').val(resultado.preco);
                    } else {
                        $('#nomeProduto' + numId + '').val("");
                        $('#precoProduto' + numId + '').val("");
                    }
                    alteraValorTotal();
                }
            });
        }
    }

    function alteraValorTotal(){
        let aPrecos     = $('*[id*=precoProduto]');
        let aQuantidade = $('*[id*=qtdProduto]');
        let aDescontos  = $('*[id*=desconto]');

        let valorTotal = 0;
        $.each(aPrecos, function (index, value) {
            valorTotal += ((this.value - aDescontos[index].value) * aQuantidade[index].value);
        });
        $('#valorTotal').val(valorTotal);
    }
</script>

<style>
    .itemProd{
        border: 1px solid black;
        border-radius: 5px;
        padding: 10px;
    }
</style>

<script src="jquery-3.3.1.min.js" type="text/javascript"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!--   Core JS Files   -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
</html>