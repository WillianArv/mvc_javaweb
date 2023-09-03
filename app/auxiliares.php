<?php

/**
 * Genera una URL con la subcarpeta "formal" incluida en la ruta.
 *
 * @param string $ruta La ruta relativa del enlace (por ejemplo, "/productos").
 *
 * @return string La URL completa con la subcarpeta "formal".
 */
function url($ruta)
{
    return $_ENV['URL_SITIO'] . $ruta;
}

/**
 * Este archivo contiene todas las funciones auxiliares que se usan en el
 * sistema, como por ejemplo, la funcion para registrar los modelos de la
 * base de datos, la funcion para obtener la ruta de un archivo, etc.
 */

/**
 * Registra los modelos de la aplicación.
 * Busca todos los archivos PHP en la carpeta "app/modelos" y los incluye.
 */

function register_models()
{
    # La función glob() es una función de PHP que devuelve un array 
    # con los nombres de los archivos que coinciden con el patrón especificado. 
    # En este caso, el patrón es "app/models/.php", lo que significa que se 
    # buscan todos los archivos con extensión .php en el directorio "app/models/".

    foreach (glob("app/models/*.php") as $file) {
        require_once($file);
    }
}


/**
 * Escribe la URL completa de un archivo en el servidor.
 *
 * @param string $tipo El tipo de archivo que se quiere obtener (css, js, imagen).
 * @param string $nombre El nombre del archivo que se quiere obtener.
 *
 * @return void
 */
function asset($tipo, $nombre)
{
    echo $_ENV['URL_SITIO'] . '/app/views/assets/' . $tipo . '/' . $nombre;
}

/**
 * Verifica si hay una sesión iniciada para el usuario actual.
 * Si no hay sesión iniciada, redirige al usuario a la página principal.
 *
 * @return void
 */
function verify_session()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . $_ENV['URL_SITIO']);
    }
}

/**
 * Verifica si el usuario actual tiene el rol especificado.
 * Si el usuario no tiene el rol especificado, redirige al usuario a la página principal.
 *
 * @param string $rol El rol que se quiere verificar.
 *
 * @return void
 */
function check_role($rol)
{
    if ($_SESSION['user']['tipo_usuario'] != $rol) {
        header('Location: ' . $_ENV['URL_SITIO'] . "/");
    }
}

/**
 * Obtiene el valor de un campo de un formulario enviado por el método POST.
 * Si el campo no está definido, devuelve una cadena vacía.
 *
 * @param string $campo El nombre del campo que se quiere obtener.
 * @param array $datos_form Los datos del formulario enviado por el método POST.
 *
 * @return string El valor del campo, o una cadena vacía si el campo no está definido.
 */
function value_form($campo, $datos_form)
{
    if (isset($datos_form[$campo]))
        return $datos_form[$campo];
    else
        return "";
}

/**
 * Carga una vista de la aplicación.
 * Busca el archivo de la vista correspondiente al controlador y acción especificados.
 * Si no se especifica una acción, carga la vista "index".
 * Si el archivo de la vista no existe, carga una vista de error predeterminada.
 *
 * @param string $controlador El nombre del controlador de la vista que se quiere cargar.
 * @param string|null $accion_vista El nombre de la acción de la vista que se quiere cargar, o null para cargar la vista "index".
 * @param array $datos Los datos que se quieren pasar a la vista.
 * @param bool $cargar_assets Si se debe cargar el archivo de assets de la vista.
 * @param bool $cargar_navbar Si se debe cargar el archivo de la barra de navegación de la vista.
 *
 * @return void
 */
function load_view($controlador, $accion_vista = null, $datos = [], $cargar_assets = true, $cargar_navbar = true)
{
    $nombreControlador = ucfirst(strtolower($controlador));
    $archivoVista = __DIR__ . '/views/' . $nombreControlador . '/' . ($accion_vista ? $accion_vista . '-view.php' : 'index-view.php');

    if ($cargar_assets) {

        if (!isset($_SESSION["user"])) {
            require_once(__DIR__ . '/views/layouts/header.php');
        } else {
            if ($_SESSION["user"]["tipo_usuario"] == "admin") {
                require_once(__DIR__ . '/views/layouts/header-admin.php');
            } else {
                require_once(__DIR__ . '/views/layouts/header.php');
            }
        }
    }

    if ($cargar_navbar) {
        require_once(__DIR__ . '/views/layouts/navbar.php');
    }

    if (file_exists($archivoVista)) {
        if ($datos) {
            extract($datos);
        }
        require_once($archivoVista);
    } else {
        // cargar una vista de error predeterminada
        require_once(__DIR__ . '/views/Error-view.php');
    }

    if ($cargar_assets) {
        if (!isset($_SESSION["user"])) {
            require_once(__DIR__ . '/views/layouts/footer.php');
        } else {
            if ($_SESSION["user"]["tipo_usuario"] == "admin") {
                require_once(__DIR__ . '/views/layouts/footer-admin.php');
            } else {
                require_once(__DIR__ . '/views/layouts/footer.php');
            }
        }
    }
}

/**
 * Muestra un Sweetalert con un mensaje
 * 
 * @param string $mensaje El mensaje a mostrar
 * @param string $tipo El tipo de mensaje a mostrar
 * 
 * @return void
 */
function show_message($titulo, $mensaje, $tipo, $url = null)
{
    $alert = "
        <script>
            Swal.fire({
                icon: '$tipo',
                title: '$titulo',
                text: '$mensaje',
                confirmButtonText: 'Aceptar'
            })
        ";

    if ($url) {
        $alert .= "
            .then(() => {
                window.location.href = '$url';
            });
        ";
    }

    $alert .= "
        </script>
    ";

    echo $alert;
}

/**
 * Almacena un producto en el carrito de compras de la sesión.
 * Si el producto ya existe en el carrito, se actualiza la cantidad.
 *
 * @param int $id_producto El ID del producto a almacenar.
 * @param int $cantidad La cantidad del producto a almacenar.
 * @param string $nombre El nombre del producto a almacenar.
 * @param float $precio El precio del producto a almacenar.
 * @param bool $sumar Si es verdadero, se suma la cantidad del producto al existente en el carrito. Si es falso, se reemplaza la cantidad del producto en el carrito.
 *
 * @return void
 */
function store_product_in_cart($id_producto, $cantidad, $imagen = "", $nombre = "", $precio = "", $sumar = true)
{
    if (!isset($_SESSION["carrito"])) {
        $_SESSION["carrito"] = array();
    }

    $productoEncontrado = false;

    foreach ($_SESSION["carrito"] as &$producto) {
        if ($producto['id'] == $id_producto) {
            $productoEncontrado = true;
            if ($sumar) {
                $producto['cantidad'] += $cantidad;
            } else {
                $producto['cantidad'] = $cantidad;
            }

            if ($producto['cantidad'] <= 0) {
                remove_product_from_cart($id_producto);
            }

            break;
        }
    }

    if (!$productoEncontrado) {
        $_SESSION["carrito"][] = array(
            'id' => $id_producto,
            'nombre' => $nombre,
            'imagen' => $imagen,
            'cantidad' => $cantidad,
            'precio' => $precio
        );
    }
}

function search_producto_in_cart($id_producto)
{
    if (isset($_SESSION["carrito"])) {
        foreach ($_SESSION["carrito"] as &$producto) {
            if ($producto['id'] == $id_producto) {
                return $producto["cantidad"];
            }
        }
    }
}

/**
 * Quita un producto del carrito de compras de la sesión.
 *
 * @param int $id_producto El ID del producto a quitar.
 *
 * @return void
 */
function remove_product_for_cart($id_producto)
{
    if (isset($_SESSION["carrito"])) {
        foreach ($_SESSION["carrito"] as $index => $producto) {
            if ($producto['id'] == $id_producto) {
                unset($_SESSION["carrito"][$index]);
                break;
            }
        }

        $_SESSION["carrito"] = array_values($_SESSION["carrito"]);
    }
}


/**
 * Devuelve el contenido del carrito de compras almacenado en la sesión.
 * Si el carrito no existe, devuelve un array vacío.
 *
 * @return array El contenido del carrito de compras.
 */
function bring_cart()
{
    if (isset($_SESSION["carrito"])) {
        return $_SESSION["carrito"];
    } else {
        return array();
    }
}


/**
 * Quita un producto del carrito de compras de la sesión.
 *
 * @param int $id_producto El ID del producto a quitar.
 *
 * @return void
 */
function remove_product_from_cart($id_producto)
{
    if (isset($_SESSION["carrito"])) {
        foreach ($_SESSION["carrito"] as $index => $producto) {
            if ($producto['id'] == $id_producto) {
                unset($_SESSION["carrito"][$index]);
                break;
            }
        }

        $_SESSION["carrito"] = array_values($_SESSION["carrito"]);
    }
}


/**  
 * Convierte una imagen de binario a base64 
 * para que pueda ser leída por el navegador
 * 
 * @param string
 * 
 * @return string
 * 
 */

function convert_image($image_binary)
{
    $imagenBase64 = base64_encode($image_binary);
    $dataURL = "data:image/webp;base64," . $imagenBase64;
    return $dataURL;
}

/**
 * Sube una imagen al servidor
 * 
 * @param string $nombreCampo El nombre del campo del formulario que contiene la imagen
 * @param string $directorio El directorio donde se va a guardar la imagen
 * 
 * @return string La ruta de la imagen
 */
function subirImagen($nombreCampo, $directorio)
{
    $uploadDirectory = __DIR__ . "/views/assets/imagenes/" . $directorio . "/";
    $nombresArchivos = array(); // Arreglo para almacenar los nombres de las imágenes

    foreach ($_FILES[$nombreCampo]['tmp_name'] as $key => $tmp_name) {
        $nombreArchivo = uniqid() . "_" . $_FILES[$nombreCampo]['name'][$key];
        $rutaArchivo = $uploadDirectory . $nombreArchivo;
        move_uploaded_file($tmp_name, $rutaArchivo);

        $nombresArchivos[] = $nombreArchivo; // Agregar el nombre al arreglo
    }

    return $nombresArchivos;
}
