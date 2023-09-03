<footer>
    <div class="container footer">
        <h1 class="logo">MAJO</h1>
        <div class="container-social">
            <a href="" class="facebook">
                <i class="fa-brands fa-facebook"></i>
                <span>Facebook</span>
            </a>
            <a href="" class="youtube">
                <i class="fa-brands fa-youtube"></i>
                <span>Youtube</span>
            </a>
            <a href="" class="instagram">
                <i class="fa-brands fa-instagram"></i>
                <span>Instagram</span>
            </a>
            <a href="" class="twiter">
                <i class="fa-brands fa-twitter"></i>
                <span>Twitter</span>
            </a>
        </div>
        <div class="user-footer">
            <ul>
                <li><a href="<?php echo (!isset($_SESSION["user"])) ? url("/login") : url("/perfil") ?>"><?php echo (!isset($_SESSION["user"])) ? "Inicia Sesión" : "Mi cuenta" ?></a></li>
                <li><a href="<?= url("/register") ?>">Registrate</a></li>
                <li><a href="">Contáctanos</a></li>
            </ul>
        </div>

        <div class="container-policies">
            <ul>
                <li><a href="">Politica de privacidad</a></li>
                <li><a href="">Políticas de devoluciones</a></li>
                <li><a href="">Términos de compras</a></li>
                <li><a href="">Preguntas frecuentes</a></li>
            </ul>
        </div>
    </div>
</footer>

<script src="<?php asset("js-bootstrap", "bootstrap.min.js") ?>"></script>
<script src="<?php asset("js-bootstrap", "bootstrap.bundle.js") ?>"></script>
<script src="<?php asset("js", "index.js?v=" . rand(1, 500)) ?>"></script>
<script src="<?php asset("js", "admin.js?v=" . rand(1, 500)) ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="<?php asset("js", "carrito.js?v=" . rand(1, 500)) ?>"></script>
<!-- <script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> -->

</body>

</html>