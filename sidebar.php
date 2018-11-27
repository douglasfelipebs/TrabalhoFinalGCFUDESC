<div class="sidebar sidebar-zindex" data-background-color="black" data-active-color="danger">

    <style>
        .sidebar-zindex{
            z-index: auto;
        }
    </style>
    <div class="sidebar-wrapper">
        <div class="logo">
            <a class="simple-text">
                J & R Informática
            </a>
        </div>

        <ul class="nav">
            <li <?php if($_SESSION['page'] == 1){ echo 'class="active"'; }?>>
                <a href="dashboard.php">
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li  <?php if($_SESSION['page'] == 2){ echo 'class="active"'; }?>>
                <a href="produtos.php">
                    <i class="ti-package"></i>
                    <p>Produtos</p>
                </a>
            </li>
            <li  <?php if($_SESSION['page'] == 3){ echo 'class="active"'; }?>>
                <a href="clientes.php">
                    <i class="ti-user"></i>
                    <p>Clientes</p>
                </a>
            </li>
            <li  <?php if($_SESSION['page'] == 4){ echo 'class="active"'; }?>>
                <a href="pedidos.php">
                    <i class="ti-shopping-cart-full"></i>
                    <p>Pedidos</p>
                </a>
            </li>
        </ul>
    </div>
</div>