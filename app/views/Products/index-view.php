<link rel="stylesheet" href="<?php asset("css", "table.css") ?>">

<div class="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-10 ">
                <h2 class="mb-5 title-table">Productos</h2>
            </div>
            <div class="col-2 text-center">
                <a href="<?= url("/product/new") ?>" class="btn btn-success "><i class="fa-solid fa-plus"></i> Nuevo producto</a>
            </div>
        </div>

        <div class="table-responsive custom-table-responsive">
            <table class="table custom-table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Color</th>
                        <th scope="col">Disponibilidad</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $num = 0;
                    foreach ($productos as $productos) {
                        $num++;
                    ?>
                        <tr scope="row">
                            <td><?php echo $num ?></td>
                            <td><?php echo $productos["nombre"] ?></td>
                            <td><?php echo $productos["descripcion"] ?></td>
                            <td><img src="<?php echo ($productos["imagen"] == "") ? asset("imagenes", "sin-imagen.png") : asset("imagenes/productos", $productos["imagen"]) ?>" alt="" srcset="" width="160px" height="160px"></td>
                            <td>$<?php echo $productos["precio"] ?></td>
                            <td><?php echo $productos["disponibilidad"] ?></td>
                            <td><?php echo $productos["categoria"]  ?></td>
                            <td>
                                <a href="product/remove/<?php echo $productos['id'] ?>" style="color:#ffff; padding:10px" class="btn btn-eliminar btn-danger"><i class="fa-solid fa-trash"></i></a>
                                <a href="product/edit/<?php echo $productos['id'] ?>" style="color:#ffff; padding:10px" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                        <tr class="spacer">
                            <td colspan="100"></td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?php asset("js", "productos.js") ?>"></script>