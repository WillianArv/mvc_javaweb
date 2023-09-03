<div class="h-100 w-100 bg-info d-flex align-items-center justify-content-center">
    <div class="card">
        <div class="card-header">
            <b>Tienda La Pequeñita - Instalador</b>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                Por favor, proporcione la información requerida a continuación, asegúrese que el usuario de la base de datos tenga permisos de creación de tablas y disparadores (triggers)
            </div>

            <form action="/instalador/crear_bd" method="post">
                <div class="form-group">
                    <label for="url">URL de la tienda</label>
                    <?php 
                        // Url con http o https según sea el caso
                        $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
                    ?>
                    <input type="text" class="form-control" id="url" name="url" required value="<?php echo $url; ?>">
                </div>
                <div class="form-group my-2">
                    <label for="host">Host DE MySQL</label>
                    <input type="text" class="form-control" id="host" name="host" required value="localhost">
                </div>
                <div class="form-group my-2">
                    <label for="usuario">Usuario de MySQL</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" required value="root">
                </div>
                <div class="form-group my-2">
                    <label for="contrasena">Contraseña de MySQL</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" value="">
                </div>
                <div class="form-group my-2">
                    <label for="nombre_bd">Nombre de la base de datos</label>
                    <input type="text" class="form-control" id="nombre_bd" name="nombre_bd" required value="tienda">
                </div>
                <div class="form-group my-2">
                    <input type="submit" value="Guardar Credenciales" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>