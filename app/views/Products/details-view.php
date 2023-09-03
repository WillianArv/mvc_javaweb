<?php
$cantidad = search_producto_in_cart($producto["id"]);
$disponibilidad = $producto["disponibilidad"] - $cantidad;
?>

<main class="container">
    <div class="grid-images">
        <div class="imagen-producto image-1">
            <img src="<?php asset("imagenes/productos", $producto["imagen"]) ?>" alt="imagen producto 1">
        </div>
        <div class="imagen-producto image-2">
            <img src="<?php asset("imagenes/productos", $imagenes[0]["ruta"]) ?>" alt="imagen producto 2">
        </div>
        <div class="imagen-producto image-3">
            <img src="<?php asset("imagenes/productos", $imagenes[1]["ruta"]) ?>" alt="imagen producto 3">
        </div>
        <div class="imagen-producto image-4">
            <img src="<?php asset("imagenes/productos", $imagenes[2]["ruta"]) ?>" alt="imagen producto 4">
        </div>
    </div>
    <!-- Detalles del producto -->
    <div class="container-details-product">
        <div class="aside-details-product">
            <div class="header-details-product">
                <h2><?= $producto["nombre"] ?></h2>
                <div class="row">
                    <div class="calification">
                        <i class="fa-solid fa-star"></i>
                        <p>4.9 - <span>141 reseñas</span></p>
                    </div>
                    <div class="share">
                        <button class="btn">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            <p>Compartir</p>
                        </button>
                        <button class="btn">
                            <i class="fa-regular fa-heart"></i>
                            <p>Guardar</p>
                        </button>
                    </div>
                </div>
            </div>

            <div class="info-details-product">
                <div class="container-acordeon">
                    <button class="acordeon-button active">
                        Descripción
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <div class="acordeon-content">
                        <p>
                            <?php echo $producto["descripcion"] ?>
                        </p>
                    </div>
                </div>
                <div class="container-acordeon">
                    <button class="acordeon-button active">
                        Características
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <div class="acordeon-content">
                        <ul>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo temporibus qui
                                repellat mollitia sequi distinctio adipisci laboriosam expedita reprehenderit?
                                Expedita eum repellat quod facilis architecto dicta facere tenetur! Distinctio,
                                illum.
                            </li>
                            <li>
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium iure
                                adipisci et, voluptatibus eius consectetur vero dignissimos repellendus animi
                                earum harum doloribus corrupti quod labore quisquam temporibus, nostrum veniam
                                eaque!
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="container-acordeon">
                    <button class="acordeon-button active">
                        Como funciona
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <div class="acordeon-content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit sunt totam
                            architecto voluptate omnis quos laboriosam iure similique qui eos, hic nulla tempora
                            ea earum fugit excepturi quasi eius rerum!
                        </p>
                    </div>
                </div>
                <div class="container-acordeon">
                    <button class="acordeon-button active">
                        Preguntas frecuentes
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <div class="acordeon-content">
                        <ul>
                            <li>
                                Preguntas
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="body-details-product">
                <div class="info-product">
                    <h2>Detalles del producto</h2>
                    <div class="info">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis amet provident
                            ipsum inventore dignissimos? Omnis recusandae tenetur minus nobis consectetur,
                            deserunt pariatur in deleniti! Nulla laboriosam quisquam similique cupiditate natus?
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem eligendi
                            debitis, laborum repellendus necessitatibus modi ut eius reprehenderit. Id tenetur
                            earum debitis fuga pariatur praesentium soluta ratione voluptate molestias quas!
                        </p>
                        <ul>
                            <li>
                                Detalles del producto
                            </li>
                        </ul>
                    </div>

                    <div class="features-product">
                        <div class="feature-product shipping">
                            <i class="fa-solid fa-truck-fast"></i>
                            <h4>Free shipping</h4>
                            <p>On orders over $50.00</p>
                        </div>
                        <div class="feature-product return">
                            <i class="fa-solid fa-phone"></i>
                            <h4>Free shipping</h4>
                            <p>On orders over $50.00</p>
                        </div>
                        <div class="feature-product delivery">
                            <i class="fa-solid fa-globe"></i>
                            <h4>Free shipping</h4>
                            <p>On orders over $50.00</p>
                        </div>
                        <div class="feature-product refund">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                            <h4>Free shipping</h4>
                            <p>On orders over $50.00</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="container-card-payment">
            <div class="card-payment">
                <div class="header">
                    <p class="price">$<?php echo $producto["precio"] ?></p>
                    <p class="count-reviews">
                        <i class="fa-solid fa-star"></i>
                        4.9 - <span>142 reseñas</span>
                    </p>
                </div>
                <div class="colors">
                    <p>Color: <span id="value-color">Negro</span></p>
                    <div class="row-colors">
                        <?php foreach ($colores as $color) {  ?>
                            <div class="container-color color-orange" data-color="<?= $color["color"] ?>" style="background-color:<?= $color["color"] ?>">
                            </div>
                        <?php } ?>
                        <!-- <div class="container-color color-white" data-color="blanco"></div>
                        <div class="container-color color-orange" data-color="naranja"></div>
                        <div class="container-color color-blue" data-color="celeste"></div>
                        <div class="container-color color-brown" data-color="marron"></div> -->
                    </div>
                </div>
                <div class="size">
                    <p>Talla: <span id="value-size">XS</span></p>
                    <div class="container-sizes">
                        <?php foreach ($tallas as $talla) {
                        ?>
                            <button class="btn-size"><?php echo $talla["talla"] ?></button>
                        <?php  } ?>

                        <!--
                        <button class="btn-size selected">XS</button>
                        <button class="btn-size"></button>
                        <button class="btn-size">M</button>
                        <button class="btn-size">L</button>
                        <button class="btn-size">XL</button>
                        <button class="btn-size">2XL</button>
                        <button class="btn-size">3XL</button>-->

                    </div>
                </div>

                <div class="quantity">
                    <div class="container-add-quantity">
                        <div class="add-quantity">
                            <button class="btn-minus" id="btn-decrement"><i class="fa-solid fa-minus"></i>
                            </button>
                            <span id="count-product">
                                1
                            </span>
                            <button class="btn-plus" id="btn-increment"><i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <?php $cantidad = search_producto_in_cart($producto['id'])  ?>
                        <button class="btn-add-to-cart btn-anadir" data-id="<?php echo $producto["id"] ?>" <?= ($cantidad == $producto["disponibilidad"]) ? "disabled" : "" ?>>
                            Añadir al carrito
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M13.5 21c-.276 0-.5-.224-.5-.5s.224-.5.5-.5.5.224.5.5-.224.5-.5.5m0-2c-.828 0-1.5.672-1.5 1.5s.672 1.5 1.5 1.5 1.5-.672 1.5-1.5-.672-1.5-1.5-1.5m-6 2c-.276 0-.5-.224-.5-.5s.224-.5.5-.5.5.224.5.5-.224.5-.5.5m0-2c-.828 0-1.5.672-1.5 1.5s.672 1.5 1.5 1.5 1.5-.672 1.5-1.5-.672-1.5-1.5-1.5m16.5-16h-2.964l-3.642 15h-13.321l-4.073-13.003h19.522l.728-2.997h3.75v1zm-22.581 2.997l3.393 11.003h11.794l2.674-11.003h-17.861z" />
                            </svg>
                        </button>
                    </div>

                    <div class="info-quantity">
                        <div class="price-tax">
                            <p>$<?php echo $producto["precio"] ?> x <span id="quantity-product">1</span></p>
                        </div>
                        <div class="value">
                            <p>$<?php echo $producto["precio"]  ?></p>
                        </div>
                    </div>
                </div>
                <div class="total">
                    <span>Total</span>
                    <div class="price-total">$<?php echo $producto["precio"] ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reseñas -->
    <div class="section-reviews">
        <h2>
            <i class="fa-solid fa-star" style="display: inline-block; vertical-align: middle;"></i>
            <p style="display: inline-block; vertical-align: middle; margin: 0;">4.87 - 142 reseñas</p>
        </h2>
        <div class="container-reviews">
            <div class="container-review">
                <div class="header-review">
                    <img src="Productos/short.png" alt="picture-user" srcset="">
                    <div class="name-user-review">
                        <p>Willian Arevalo</p>
                        <span>05 de agosto de 2023</span>
                    </div>
                    <div class="stars-review">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i style="color:#64748b" class="fa-solid fa-star"></i>
                    </div>
                </div>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia maiores ut ipsa deleniti
                    voluptatum nostrum ex? Dolore quae error temporibus excepturi itaque ipsum incidunt cum,
                    sunt aspernatur delectus voluptatem sequi?
                </p>
            </div>
            <div class="container-review">
                <div class="header-review">
                    <img src="Productos/yo.jpg" alt="picture-user" srcset="">
                    <div class="name-user-review">
                        <p>Willian Arevalo</p>
                        <span>05 de agosto de 2023</span>
                    </div>
                    <div class="stars-review">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia maiores ut ipsa deleniti
                    voluptatum nostrum ex? Dolore quae error temporibus excepturi itaque ipsum incidunt cum,
                    sunt aspernatur delectus voluptatem sequi?
                </p>
            </div>
            <div class="container-review">
                <div class="header-review">
                    <img src="Productos/short.png" alt="picture-user" srcset="">
                    <div class="name-user-review">
                        <p>Willian Arevalo</p>
                        <span>05 de agosto de 2023</span>
                    </div>
                    <div class="stars-review">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia maiores ut ipsa deleniti
                    voluptatum nostrum ex? Dolore quae error temporibus excepturi itaque ipsum incidunt cum,
                    sunt aspernatur delectus voluptatem sequi?
                </p>
            </div>
            <div class="container-review">
                <div class="header-review">
                    <img src="Productos/short.png" alt="picture-user" srcset="">
                    <div class="name-user-review">
                        <p>Willian Arevalo</p>
                        <span>05 de agosto de 2023</span>
                    </div>
                    <div class="stars-review">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia maiores ut ipsa deleniti
                    voluptatum nostrum ex? Dolore quae error temporibus excepturi itaque ipsum incidunt cum,
                    sunt aspernatur delectus voluptatem sequi?
                </p>
            </div>
        </div>

        <button class="btn-show-reviews">
            Mostrar todas las reseñas
        </button>
    </div>
</main>
<script>
    const disponibilidad = <?php echo $disponibilidad ?>
</script>
<script src="<?php asset("js", "details.js?v=" . rand(1, 500)) ?>"></script>