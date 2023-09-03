<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<section class="container container-productos-relacionados">
    <h2>Ultimos productos agregados</h2>
    <div class="cards-productos-relacionados">

        <?php
        foreach ($productos as $productos) {
        ?>
            <div class="card-producto-relacionado">
                <div class="image-product">
                    <img src="<?php asset("imagenes/productos", $productos["imagen"]) ?>" alt="" />
                </div>

                <div class="info-product">
                    <div class="container-title">
                        <h4><?php echo $productos["nombre"]  ?></h4>
                        <div class="container-title-details">
                            <span> Disponibilidad: <?php echo $productos["disponibilidad"] ?> </span>
                        </div>
                    </div>
                    <div class="container-price">
                        <span>$<?php echo $productos["precio"] ?></span>
                        <p>
                            <i class="fa-solid fa-star"></i>
                            4.4 (65 reseñas)
                        </p>
                    </div>

                    <div class="button-group">
                        <?php $cantidad = search_producto_in_cart($productos['id'])  ?>
                        <button class="btn-add-to-bag btn-anadir" data-id="<?php echo $productos['id'] ?>" type="button" <?= ($cantidad == $productos["disponibilidad"]) ? "disabled" : "" ?>>
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M13.5 21c-.276 0-.5-.224-.5-.5s.224-.5.5-.5.5.224.5.5-.224.5-.5.5m0-2c-.828 0-1.5.672-1.5 1.5s.672 1.5 1.5 1.5 1.5-.672 1.5-1.5-.672-1.5-1.5-1.5m-6 2c-.276 0-.5-.224-.5-.5s.224-.5.5-.5.5.224.5.5-.224.5-.5.5m0-2c-.828 0-1.5.672-1.5 1.5s.672 1.5 1.5 1.5 1.5-.672 1.5-1.5-.672-1.5-1.5-1.5m16.5-16h-2.964l-3.642 15h-13.321l-4.073-13.003h19.522l.728-2.997h3.75v1zm-22.581 2.997l3.393 11.003h11.794l2.674-11.003h-17.861z" />
                            </svg>
                            Añadir al carrito
                            <span id="count-product" style="display:none">
                                1
                            </span>
                        </button>

                        <a href="<?= url("/product/details/" . $productos['id']) ?>" class="btn-quick-view">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Vista previa
                        </a>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</section>