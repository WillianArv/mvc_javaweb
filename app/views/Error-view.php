<link rel="stylesheet" href="<?php asset("css", "error.css") ?>">
<div class="error-container">
    <div class="error-content">
        <h1 class="title-error">Error 404</h1>
        <p class="text-error">¡Oops! La página que estás buscando no se encuentra disponible.</p>
        <a class="link-error" href="<?= (isset($_SESSION["user"])) ? (($_SESSION["user"]["tipo_usuario"]) == "admin") ? url("/admin") : url("/") : url("/") ?>">Volver a la página de inicio</a>
    </div>
</div>