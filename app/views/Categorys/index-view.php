<link rel="stylesheet" href="<?php asset("css", "modal.css?v=" . rand(1, 500)) ?>">
<link rel="stylesheet" href="<?php asset("css", "table.css?v=" . rand(1, 500)) ?>">

<!-- Modal -->
<div class="modal" id="modal-Category" style="display:<?php echo ($accion == "editar" ? "block" : "none") ?>">
    <div class="modal-content">
        <span class="close" id="closeModalBtn">&times;</span>
        <h2><?php echo ($accion == "editar" ? "Editar" : "Crear") ?> categoría</h2>
        <form action="<?php echo ($accion == "editar") ? url("/category/update/" . value_form("id", $form_data)) : url("/category/insert")  ?>" method="POST" id="formCategory">
            <div class="row">
                <div class="col-2 mt-2">
                    <label for="" class="form-label">Nombre:</label>
                </div>
                <div class="col-10">
                    <input type="text" id="inputCategoria" value="<?php echo value_form("nombre", $form_data) ?>" name="nombre" class="form-control" placeholder="Ingrese el nombre de la categoría">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-2">
                    <label for="" class="form-label">Descripción:</label>
                </div>
                <div class="col-10">
                    <textarea name="descripcion" id="" cols="30" placeholder="Ingresa la descripción de la categoría" rows="10" class="form-control" style="resize: none;"><?php echo value_form("descripcion", $form_data) ?></textarea>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-warning"><?php echo $accion == "editar" ? "EDITAR" : "INGRESAR" ?></button>
                <a href="category" class="btn btn-danger">CANCELAR</a>
            </div>
        </form>
    </div>
</div>
<!-- Modal end -->

<div class="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-10 ">
                <h2 class="mb-5 title-table">Categorías</h2>
            </div>
            <div class="col-2 mt-4">
                <button class="btn btn-success" id="openModalBtn"> <i class="fa-solid fa-plus"></i> Ingresar nueva</button>
            </div>
        </div>

        <div class="table-responsive custom-table-responsive">
            <table class="table custom-table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaCategoria">
                    <?php
                    $num = 0;
                    foreach ($categorias as $categoria) {
                        $num++;
                    ?>
                        <tr>
                            <td><?php echo $num ?></td>
                            <td><?php echo $categoria['nombre']; ?></td>
                            <td><?php echo $categoria['descripcion'] ?></td>
                            <td>
                                <a href="category/edit/<?php echo $categoria['id'] ?>" class="btn btn-sm btn-warning"><i style="color:#ffff;padding:5px" class="fa-solid fa-pen-to-square"></i></a>
                                <a href="category/remove/<?php echo $categoria['id'] ?>" class="btn btn-eliminar btn-sm btn-danger"><i style="color:#ffff; padding:5px" class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr class="spacer">
                            <td colspan="100"></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var accion = "<?php echo $accion ?>";
</script>
<script src="<?php asset("js", "category.js") ?>"></script>