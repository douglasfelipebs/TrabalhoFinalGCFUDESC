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
            <!--                <li>
                                <a href="user.html">
                                    <i class="ti-user"></i>
                                    <p>User Profile</p>
                                </a>
                            </li>-->
<!--            <li>
                <a href="table.html">
                    <i class="ti-view-list-alt"></i>
                    <p>Table List</p>
                </a>
            </li>-->
            <!--                <li>
                                <a href="typography.html">
                                    <i class="ti-text"></i>
                                    <p>Typography</p>
                                </a>
                            </li>-->
            <!--                <li>
                                <a href="icons.html">
                                    <i class="ti-pencil-alt2"></i>
                                    <p>Icons</p>
                                </a>
                            </li>-->
            <!--                <li>
                                <a href="maps.html">
                                    <i class="ti-map"></i>
                                    <p>Maps</p>
                                </a>
                            </li>-->
            <li>
                <a href="notifications.html">
                    <i class="ti-bell"></i>
                    <p>Notifications</p>
                </a>
            </li>
            <!--                <li class="active-pro">
                                <a href="upgrade.html">
                                    <i class="ti-export"></i>
                                    <p>Upgrade to PRO</p>
                                </a>
                            </li>-->
        </ul>
    </div>
</div>