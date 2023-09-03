<link rel="stylesheet" href="<?php asset("css", "productos.css?v=" . rand(1, 500)) ?>">
<link rel="stylesheet" href="<?php asset("css", "modal.css?v=" . rand(1, 500)) ?>">

<div class="contenedor">
    <h2 class="text-center"><?php echo ($accion == "editar") ? "Editar" : "Nuevo" ?> producto</h2>

    <form id="formProduct" method="POST" action="<?= ($accion == "editar" ? url("/product/update/" . value_form("id", $form_data)) : url("/product/insert"))  ?>" enctype="multipart/form-data" class="form-product">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" value="<?php echo ($accion == "editar")  ? value_form("nombre", $form_data) : "" ?>" id="nombreProduct" name="nombre" placeholder="Ingrese el nombre del producto">
                    <span class="required-label" class="required-span"><b>* Obligatorio</b></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcionProduct" name="descripcion" placeholder="Ingrese la descripción del producto"><?php echo ($accion == "editar")  ? value_form("descripcion", $form_data) : "" ?></textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="nombre">Precio:</label>
                    <input type="number" value="<?php echo ($accion == "editar")  ? value_form("precio", $form_data) : "" ?>" id="precio" name="precio" placeholder="Ingrese el precio del producto">
                    <span class="required-label" class="required-span"><b>* Obligatorio</b></span>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="imagen_principal"><?= ($accion == "editar" ? "Editar imagen:" : "Imagen principal:") ?></label>
                    <input type="file" id="file-upload" name="imagen_principal[]" multiple accept="image/*" />
                    <label for="file-upload" class="custom-file-upload">Seleccionar archivo</label>
                    <span class="required-label" class="required-span"><b>* Obligatorio</b></span>
                </div>
            </div>

            <div class="col-lg-6 mx-auto">
                <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <div class="row">
                        <div class="col-10">
                            <select id="selectCategory" name="categoria" required>
                                <option value="Ninguno">Seleccione una categoría</option>
                                <?php
                                foreach ($categorias as $categorias) {
                                ?>
                                    <option value="<?php echo $categorias["id"] ?>" <?php echo ($accion == "editar") ? ((value_form("categoria", $form_data) == $categorias["nombre"] ? "selected" : "")) : "" ?>><?php echo $categorias["nombre"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-2">
                            <a class="btn btn-warning" id="openModalBtn" style="padding:11px"><i class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if ($accion == "editar") {
            ?>
                <div class="col-lg-6">
                    <div class="form-group text-center">
                        <label for="" class="form-label">Imagen actual</label>
                        <img src="<?= (value_form("imagen", $form_data) == "") ? asset("imagenes", "sin-imagen.png") : convert_image(value_form("imagen", $form_data))  ?>" alt="" srcset="" width="150" height="150">
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="list-group">
                    <label for="">Colores:</label>
                    <label class="list-group-item">
                        <input class="form-check-input" type="checkbox" value="black" name="selected_colors[]">
                        Negro
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input" type="checkbox" value="red" name="selected_colors[]">
                        Rojo
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input" type="checkbox" value="orange" name="selected_colors[]">
                        Anaranjado
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input" type="checkbox" value="pink" name="selected_colors[]">
                        Rosa
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input" type="checkbox" value="blue" name="selected_colors[]">
                        Azul
                    </label>
                    <input type="text" class="form-control mt-3" placeholder="Nuevo color" style="display:none" id="NewColorInput">
                    <button class="btn btn-success mt-3" type="button" id="NewColorButton"><i class="fa-solid fa-plus" id="icon-button"></i></button>
                    <span class="required-label" class="required-span"><b>* Obligatorio</b></span>
                </div>
            </div>

            <div class="col-4">
                <div class="list-group">
                    <label for="">Tallas:</label>
                    <label class="list-group-item">
                        <input class="form-check-input-tallas" type="checkbox" value="XS" name="selected_size[]">
                        XS
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input-tallas" type="checkbox" value="S" name="selected_size[]">
                        S
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input-tallas" type="checkbox" value="M" name="selected_size[]">
                        M
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input-tallas" type="checkbox" value="L" name="selected_size[]">
                        L
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input-tallas" type="checkbox" value="XL" name="selected_size[]">
                        XL
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input-tallas" type="checkbox" value="2XL" name="selected_size[]">
                        2XL
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input-tallas" type="checkbox" value="3XL" name="selected_size[]">
                        3XL
                    </label>
                    <span class="required-label" class="required-span"><b>* Obligatorio</b></span>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="nombre">Disponibilidad:</label>
                    <input type="number" value="<?php echo ($accion == "editar")  ? value_form("disponibilidad", $form_data) : "" ?>" id="disponibilidad" name="disponibilidad" placeholder="Ingrese la disponibilidad del producto">
                    <span class="required-label" class="required-span"><b>* Obligatorio</b></span>
                </div>
            </div>
        </div>

        <div class="row text-center">

        </div>
        <div class="form-group text-center">
            <button class="submit-btn" id="insertProduct"><?php echo ($accion == "editar") ? "Editar" : "Ingresar"  ?></button>
            <a href="<?= url("/product") ?>" style="padding:11px; background-color:brown" class="submit-btn">Cancelar</a>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal" id="modal-Category">
    <div class="modal-content text-center">
        <span class="close" id="closeModalBtn">&times;</span>
        <h2>Nueva categoría</h2>
        <form id="modalCategoryForm">
            <div class="row">
                <div class="col-2 mt-2">
                    <label for="" class="form-label">Nombre:</label>
                </div>
                <div class="col-10">
                    <input type="text" id="inputCategoriaProduct" name="nombre" class="form-control" placeholder="Ingrese el nombre de la categoría">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-2">
                    <label for="" class="form-label">Descripción:</label>
                </div>
                <div class="col-10">
                    <textarea name="descripcion" id="inputDescripcion" cols="30" placeholder="Ingresa la descripción de la categoría" rows="10" class="form-control" style="resize: none;"> </textarea>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-warning" type="submit">INGRESAR</button>
                <button id="CancelarButton" type="button" class="btn btn-danger">CANCELAR</button>
            </div>
        </form>
    </div>
</div>
<!-- Modal end -->

<script src="<?php asset("js", "productos.js?v=" . rand(1, 500)) ?>"></script>