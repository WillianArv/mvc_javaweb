<?php $carrito = bring_cart(); ?>
<link rel="stylesheet" href="<?php asset("css", "index.css?v=" . rand(1, 500))  ?>">
<link rel="stylesheet" href="<?php asset("css", "table.css?v=" . rand(1, 500)) ?>">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="content">
    <div class="container mt-4">
        <div class="text-center">
            <h2 class="mb-5 title-table">Carrito</h2>
        </div>
        <div class="table-responsive custom-table-responsive">
            <table class="table custom-table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $num = 0;
                    foreach ($carrito as $carrito) {
                        $num++;
                    ?>
                        <tr>
                            <td><?= $num  ?></td>
                            <td><img src="<?php asset("imagenes/productos", $carrito["imagen"]) ?>" alt="" width="100px" height="100px"></td>
                            <td><?= $carrito["nombre"] ?></td>
                            <td>$<?= $carrito["precio"] ?></td>
                            <td>
                                <input min="0" name="quantity" type="number" onchange="actualizarCantidad(this.value, <?php echo $carrito['id'] ?>)" value="<?php echo $carrito['cantidad'] ?>" />
                            </td>
                            <td>
                                $<?php
                                    $subtotal = $carrito["cantidad"] * $carrito["precio"];
                                    echo number_format($subtotal, 2)
                                    ?>
                            </td>
                            <td>
                                <a href="<?= url("/carrito/quitar_producto/" . $carrito['id']) ?>">
                                    <svg style="fill:#ffff" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                        <path d="M12 11.293l10.293-10.293.707.707-10.293 10.293 10.293 10.293-.707.707-10.293-10.293-10.293 10.293-.707-.707 10.293-10.293-10.293-10.293.707-.707 10.293 10.293z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <tr class="spacer">
                            <td colspan="100"></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <?php if ($total == 0) { ?>
                            <td colspan="7">NO HAS AGREGADO NINGUN PRODUCTO </td>
                        <?php } else {    ?>

                            <td colspan="6">TOTAL:</td>
                            <td>$<?php echo number_format($total, 2) ?></td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    input[type="number"] {
        width: 50px;
        padding: 5px;
        font-size: 14px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
</style>