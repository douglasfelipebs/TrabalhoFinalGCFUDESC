<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Dashboard - J & R Informática</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <script src="jquery-3.3.1.min.js" type="text/javascript"></script>

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

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
            $_SESSION['page'] = 2;
            $sItemAtivo = 'Produto';
            $sSql = "SELECT * FROM tbproduto ORDER BY procodigo";
            include_once './sidebar.php';
                if (isset($_GET["alert"])) {
                    if ($_GET["alert"] == 1) {
                        ?>
                        <script>notifyInsersao('top', 'rigth');</script>
                        <?php
                    }
                    if ($_GET["alert"] == 2) {
                        ?>
                        <script>swal("Sucesso!", "Produto Excluído com Sucesso!", "error");</script>
                        <?php
                    }
                }
        ?>

        <div class="main-panel">
            <?php include_once './navigation.php';?>
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
                                    <h4 class="title"><?php echo $sItemAtivo?></h4>
                                    <button class="btn" type="button" data-toggle="modal" data-target="#ModalAddProduto"><i class="fa fa-plus"></i></button>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover">
                                        <thead>
                                            <?php 
                                                echo '<th>Código</th>';
                                                echo '<th>Nome</th>';
                                                echo '<th>Descrição</th>';
                                                echo '<th>Fabricante</th>';
                                                echo '<th>Preço</th>';
                                                echo '<th>Alterar</th>';
                                                echo '<th>Excluir</th>';
                                            ?>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $oQuery = pg_query($conection, $sSql);
                                                $iCodigo = 0;
                                                while($aItem = pg_fetch_row($oQuery)){
                                                    echo '<tr>';
                                                    foreach ($aItem as $key => $value) {
                                                        if($key == 0){
                                                            $iCodigo = $value;
                                                        }
                                                        echo '<td> <label id='. $key. $iCodigo .'>' . $value . '</label></td>';
                                                    }
                                                    echo '<td><button class="btn" onclick="alterarItem('.$iCodigo.')" type="button" data-toggle="modal" data-target="#ModalAltProduto"><i class="fa fa-edit"></i></button></td>';
                                                    echo '<td><button class="btn" onclick="exclui('.$iCodigo.')"><i class="fa fa-trash"></i></button></td>';
                                                    echo '</tr>';
                                                }
                                            ?>
                                            <script>
                                                function exclui(id){
                                                    window.location = 'exclui.php?id='+ id +'&tipo=pro';
                                                }
                                                
                                                function alterarItem(id){
                                                    var oCodigo     = document.getElementById('codigoAltera');
                                                    var oNome       = document.getElementById('nomeAltera');
                                                    var oDescricao  = document.getElementById('descricaoAltera');
                                                    var oFabricante = document.getElementById('fabricanteAltera');
                                                    var oPreco      = document.getElementById('precoAltera');
                                                    
                                                    var iCodigoAtual     = document.getElementById('0' + id).textContent;
                                                    var sNomeAtual       = document.getElementById('1' + id).textContent;
                                                    var sDescricaoAtual  = document.getElementById('2' + id).textContent;
                                                    var sFabricanteAtual = document.getElementById('3' + id).textContent;
                                                    var fPrecoAtual      = document.getElementById('4' + id).textContent;
                                                    
                                                    $(oCodigo).val(iCodigoAtual);
                                                    $(oNome).val(sNomeAtual);
                                                    $(oDescricao).val(sDescricaoAtual);
                                                    $(oFabricante).val(sFabricanteAtual);
                                                    $(oPreco).val(fPrecoAtual);
                                                }
                                                
                                                function notifyInsersao(from, align){
                                                    color = Math.floor(1);

                                                    $.notify({
                                                    icon: "ti-check",
                                                    message: "Produto inserido com Sucesso!"

                                                },{
                                                    type: type[1],
                                                    timer: 4000,
                                                    placement: {
                                                        from: from,
                                                        align: align
                                                    }
                                                });
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
            <style>
                .modal-items {
                    z-index: 2048
                }

                .ffl-wrapper>input{
                    border-radius: 5px;
                }
                
                .ffl-wrapper>textarea{
                    border-radius: 5px;
                }
                
                .ffl-label {
                    color: #909090;
                    line: {
                        height: 1.2;
                    }
                    .ffl-floated & {
                        color: #0289f3;
                        font: {
                            size: 0.75rem;
                        }
                    }    
                }

                form {
                    max-width: 30rem;
                    margin: 2rem auto 0;
                    background-color: #ffffff;
                    padding: 1rem;
                    &:after {
                        content: "";
                        display: block;
                        clear: both;
                    }
                }

                input,
                textarea,
                select {
                    transition: border-bottom 100ms ease;
                    display: block;
                    width: 100%;
                    padding: 0;
                    margin-bottom: 1rem;
                    box: {
                        shadow: none;
                    }
                    appearance: none;
                    outline: none;
                    background: {
                        color: transparent;
                    }
                    border: {
                        style: none;
                        bottom: {
                            width: 1px;
                            style: solid;
                            color: rgba(#000000, 0.2);
                        }
                    }
                    height: 1.875rem;
                    &:hover {
                        border: {
                            bottom: {
                                width: 1px;
                                color: #909090;
                            }
                        }
                    }
                    &:focus {
                        border: {
                            bottom: {
                                width: 1px;
                                color:  #0289f3;
                            }
                        }
                    }    
                }

                textarea {
                    resize: none;
                    min: {
                        height: 1.875rem;
                    }
                }

                label {
                    > span {
                        color: #cccccc;
                    }
                }
                
                input[type='number'] {
                    -moz-appearance:textfield;
                }

                input::-webkit-outer-spin-button,
                input::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                }

            </style>
            <div class="modal fade" data-backdrop="false" id="ModalAddProduto" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content modal-items">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TituloModalCentralizado">Cadastro de Produto
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <form name="cadastro" id="cadastro" action="cadastra.php" method="POST">
                            <div class="form-group">
                                <label for="codigo" class="ffl-label" hidden>Código</label>
                                <input type="text" id="codigo" disabled name="codigo" hidden>
                            </div>
                            <div class="form-group">
                                <label for="nome" class="ffl-label">Nome</label>
                                <input type="text" class="form-control border-input" id="nome" name="nome">
                            </div>
                            <div class="form-group">
                                <label for="descricao" class="ffl-label">Descrição <span>(opcional)</span></label>
                                <textarea id="descricao" class="form-control border-input" name="descricao"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="fabricante" class="ffl-label">Fabricante</label>
                                <input type="text" class="form-control border-input" id="fabricante" name="fabricante">
                            </div>
                            <div class="form-group">
                                <label for="preco" class="ffl-label">Preço</label>
                                <input type="number" class="form-control border-input" id="preco" name="preco">
                            </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                      <button type="submit" form="cadastro" class="btn btn-primary">Cadastrar</button>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal fade" data-backdrop="false" id="ModalAltProduto" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content modal-items">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TituloModalCentralizado">Alterar Produto 
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <form name="altera" id="altera" action="alterar.php" method="POST">
                            <div class="form-group">
                                <label for="codigoAltera" class="ffl-label" hidden>Código</label>
                                <input type="text" id="codigoAltera" name="codigoAltera" hidden>
                            </div>
                            <div class="form-group">
                                <label for="nomeAltera" class="ffl-label">Nome</label>
                                <input type="text" id="nomeAltera" class="form-control border-input" name="nomeAltera">
                            </div>
                            <div class="form-group">
                                <label for="descricaoAltera" class="ffl-label">Descrição <span>(opcional)</span></label>
                                <textarea id="descricaoAltera" class="form-control border-input" name="descricaoAltera"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="fabricanteAltera" class="ffl-label">Fabricante</label>
                                <input type="text" id="fabricanteAltera" class="form-control border-input" name="fabricanteAltera">
                            </div>
                            <div class="form-group">
                                <label for="precoAltera" class="ffl-label">Preço</label>
                                <input type="number" id="precoAltera" class="form-control border-input" name="precoAltera">
                            </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                      <button type="submit" form="altera" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                  </div>
                </div>
            </div>
            <?php include_once './footer.php';?>
        </div>
    </div>
</body>

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