<?php
$carrito = bring_cart();
$total = 0;
$cantidad = 0;

foreach ($carrito as $producto) {
    $total += floatval($producto['cantidad']) * floatval($producto['precio']);
    $cantidad += $producto['cantidad'];
}
?>

<header>
    <div class="header container">
        <h1 class="logo">MAJO</h1>
        <nav>
            <ul class="menu-nav">
                <li><a href="<?= url("/") ?>">Inicio</a></li>
                <li><a href="">Acerca</a></li>
                <li><a href="#">Hombres</a></li>
                <li><a href="#">Mujeres</a></li>
                <li><a href="#">Contactanos</a></li>
            </ul>
        </nav>

        <div class="menu-hamburger">
            <i class="fa-solid fa-bars"></i>
        </div>

        <div class="carrito">
            <a href="<?php echo url("/carrito") ?>"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                    <path d="M13.5 21c-.276 0-.5-.224-.5-.5s.224-.5.5-.5.5.224.5.5-.224.5-.5.5m0-2c-.828 0-1.5.672-1.5 1.5s.672 1.5 1.5 1.5 1.5-.672 1.5-1.5-.672-1.5-1.5-1.5m-6 2c-.276 0-.5-.224-.5-.5s.224-.5.5-.5.5.224.5.5-.224.5-.5.5m0-2c-.828 0-1.5.672-1.5 1.5s.672 1.5 1.5 1.5 1.5-.672 1.5-1.5-.672-1.5-1.5-1.5m16.5-16h-2.964l-3.642 15h-13.321l-4.073-13.003h19.522l.728-2.997h3.75v1zm-22.581 2.997l3.393 11.003h11.794l2.674-11.003h-17.861z" />
                </svg>
            </a>
            <div class="count-products-cart"><?php echo $cantidad ?></div>
        </div>

        <div class="user-perfil">
            <ul class="menu-user-horizontal">
                <li>
                    <a href="#">
                        <img src="<?php echo (!isset($_SESSION["user"])) ? asset("imagenes", "sin-perfil.jpg") : (($_SESSION["user"]["perfil"] == "") ? asset("imagenes", "sin-perfil.jpg") : convert_image($_SESSION["user"]["perfil"])) ?>" alt="" srcset="">
                    </a>
                    <ul class="menu-user-vertical">
                        <li><a href="<?php echo (!isset($_SESSION["user"])) ? url("/login") : url("/perfil") ?>">
                                <?php echo (!isset($_SESSION["user"])) ? "Inicia Sesión" : $_SESSION["user"]["nombre"] . " " . $_SESSION["user"]["apellido"] ?>
                            </a></li>
                        <li><a href="">Compras</a></li>
                        <li class=" separator"></li>
                        <li><a href="#" onclick="closeSession()">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="menu-responsive">
        <h1 class="logo-responsive">MAJO</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab non inventore libero? Culpa, quae magni libero
            voluptatum a officiis aliquam?</p>
        <div class="container-social-responsive">
            <a href="" class="facebook">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="" class="youtube">
                <i class="fa-brands fa-youtube"></i>
            </a>
            <a href="" class="instagram">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="" class="twiter">
                <i class="fa-brands fa-twitter"></i>
            </a>
        </div>

        <nav>
            <ul class="menu-nav-responsive">
                <li><a href="<?= url("/") ?>">Inicio</a></li>
                <li><a href="">Acerca</a></li>
                <li><a href="">Hombres</a></li>
                <li><a href="">Mujeres</a></li>
                <li><a href="">Contactanos</a></li>
                <li class="separator"></li>
                <li><a href="<?php echo (!isset($_SESSION["user"])) ? url("/login") : url("/perfil") ?>"><?php echo (!isset($_SESSION["user"])) ? "Inicia Sesión" : "Mi cuenta" ?></a></li>
                <li><a href="">Compras</a></li>
                <li><a href="#" onclick="closeSession()">Cerrar Sesión</a></li>
            </ul>
        </nav>
        <div class="btn-close-responsive"><i class="fa-solid fa-xmark"></i></div>
    </div>
    <div id="overlay"></div>
</header>