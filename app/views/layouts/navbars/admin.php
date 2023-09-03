<link rel="stylesheet" href="<?php asset("css", "navbar-admin.css?v=" . rand(1, 500)) ?>">
<header id="header">
    <div class="header_toggle"> <i style="color:#ffff" class='bx bx-menu' id="header-toggle"></i> </div>
</header>

<div class="l-navbar" id="nav-bar">

    <nav class="nav">
        <div>
            <div class="nav_logo">
                <i class="fa-solid fa-cat" style="color:#ffff"></i>
                <span class="nav_logo-name">MOONSTORE</span>
            </div>
            <div class="nav_list">
                <a href=" <?= url("/category") ?> " class="nav_link">
                    <i class='bx bx-category nav_icon'></i>
                    <span class="nav_name">CATEGORIAS</span>
                </a>
                <a href="<?= url("/product") ?>" class="nav_link">
                    <i class='bx bx-box nav_icon'></i>
                    <span class="nav_name">PRODUCTOS</span>
                </a>
                <a href="admin_estadisticas" class="nav_link">
                    <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                    <span class="nav_name">ESTADISTICAS</span>
                </a>
                <a href="admin_noticias" class="nav_link">
                    <i class='bx bx-news nav_icon'></i>
                    <span class="nav_name">NOTICIAS</span>
                </a>
                <a href="<?= url("/user") ?>" class="nav_link">
                    <i class='bx bx-user-pin nav_icon'></i>
                    <span class="nav_name">USUARIOS</span>
                </a>
                <a href="admin_compras" class="nav_link">
                    <i class='bx bx-package nav_icon'></i>
                    <span class="nav_name">COMPRAS</span>
                </a>

                <a class="nav_link">
                    <i class='bx bx-user nav_icon'></i> <span class="nav_name"><?php echo $_SESSION['user']["nombre"] ?></span>
                </a>
            </div>
        </div>
        <a href="#" onclick="closeSession()" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Salir</span></a>
    </nav>
</div>