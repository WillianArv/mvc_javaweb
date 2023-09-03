<link rel="stylesheet" href="<?php asset("css", "table.css?v=" . rand(1, 500)) ?>">
<div class="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-10 ">
                <h2 class="mb-5 title-table">Usuarios</h2>
            </div>
            <div class="col-2 mt-4">
                <button class="btn btn-success" id="openModalBtn"> <i class="fa-solid fa-plus"></i> Ingresar nuevo</button>
            </div>
        </div>

        <div class="table-responsive custom-table-responsive">
            <table class="table custom-table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Municipio</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Fecha registro</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaCategoria">
                    <?php
                    $num = 0;
                    foreach ($usuarios as $usuario) {
                        $num++;
                    ?>
                        <tr>
                            <td><?php echo $num ?></td>
                            <td><img src="<?php echo ($usuario["perfil"] == "") ? asset("imagenes", "sin-perfil.jpg") : convert_image($usuario["perfil"]) ?>" alt="foto_usuario" srcset="" width="80px" height="80px" style="object-fit:cover; border-radius:50%"></td>
                            <td><?php echo $usuario['nombre']; ?></td>
                            <td><?php echo $usuario['email'] ?></td>
                            <td><?php echo $usuario['dirección'] ?></td>
                            <td><?php echo $usuario['municipio'] ?></td>
                            <td><?php echo $usuario['departamento'] ?></td>
                            <td><?php echo $usuario['fecha_registro'] ?></td>
                            <td><?php echo $usuario['tipo_usuario'] ?></td>
                            <td>
                                <a href="user/edit/<?= $usuario['id']  ?>" class="btn btn-sm btn-warning"><i style="color:#ffff;padding:5px" class="fa-solid fa-pen-to-square"></i></a>
                                <a href="user/remove/<?= $usuario['id'] ?>" class="btn btn-eliminar btn-sm btn-danger"><i style="color:#ffff; padding:5px" class="fa-solid fa-trash"></i></a>
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

<script src="<?php asset("js", "usuarios.js?v=" . rand(1, 500)) ?>"></script>