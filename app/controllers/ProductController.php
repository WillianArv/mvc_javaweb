<?php
require_once("app/database/Connection.php");

class ProductController
{
    private $id;
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function index($exito = false, $errores_validacion = null, $error = null, $form_data = null, $accion = null)
    {
        check_role("admin");
        $productModel = new Product_model($this->conn);
        $productos = $productModel->consult_products();

        load_view(
            "Products",
            "index",
            [
                "productos" => $productos,
                "errores_validacion" => $errores_validacion,
                "error" => $error,
                "form_data" => $form_data,
                "accion" => $accion

            ]
        );

        if ($exito) {
            show_message("¡Éxito!", $exito, "success", url("/product"));
        }

        if ($error) {
            show_message("Error", $error, "warning", url("/product"));
        }
    }

    public function index_edit($exito = false, $errores_validacion = null, $error = null, $form_data = null, $accion = null)
    {
        check_role("admin");

        $categoryModel = new Category_model($this->conn);
        $category = $categoryModel->consult_category();

        load_view(
            "products",
            "new",
            [
                "categorias" => $category,
                "errores_validacion" => $errores_validacion,
                "error" => $error,
                "form_data" => $form_data,
                "accion" => $accion
            ]
        );

        if ($exito) {
            show_message("¡Éxito!", $exito, "success", url("/product"));
        }

        if ($error) {
            show_message("Error", $error, "warning", url("/product"));
        }
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function new()
    {
        check_role("admin");
        $categoryModel = new Category_model($this->conn);
        $category = $categoryModel->consult_category();

        load_view(
            "Products",
            "new",
            [
                "categorias" => $category,
                "accion" => "crear"
            ]
        );
    }

    public function edit()
    {

        $productModel = new Product_model($this->conn);
        $product = $productModel->get_product_by_id($this->id);

        if (!$product) {
            $this->index(false, null, "El producto no existe", null, "editar");
            return;
        }

        $this->index_edit(false, null, null, $product, "editar");
    }

    public function update()
    {
        $productModel = new Product_model($this->conn);
        $getImagen = $productModel->get_product_by_id($this->id);

        if (isset($_FILES["imagen_principal"]) && $_FILES["imagen_principal"]["error"] === UPLOAD_ERR_OK) {
            $nombreArchivo = $_FILES["imagen_principal"]["name"];
            $imagenTemporal = $_FILES["imagen_principal"]["tmp_name"];
            $archivo = file_get_contents($imagenTemporal);
        } else {
            $archivo = $getImagen["imagen"];
        }


        $data = array(
            "nombre" => $_POST["nombre"],
            "descripcion" => $_POST["descripcion"],
            "imagen" => $archivo,
            "precio" => $_POST["precio"],
            "color" => $_POST["color"],
            "disponibilidad" => $_POST["disponibilidad"],
            "categoria" => $_POST["categoria"],
            "id" => $this->id
        );

        $update = $productModel->update_product($data);

        if ($update) {
            $this->index_edit("Producto editado correctamente");
        } else {
            $this->index_edit(false, null, "Error al editar el producto", $_POST, "editar");
        }
    }

    public function insert()
    {
        $productModel = new Product_model($this->conn);

        $selectedColors = $_POST['selected_colors'];
        $selectedSizes = $_POST['selected_size'];

        if (isset($_FILES["imagen_principal"])) {
            $imagen = subirImagen("imagen_principal", "productos");
        }

        $search_name = $productModel->search_by_name_product($_POST["nombre"]);
        if ($search_name) {
            $this->index(false, null, "Ese producto ya existe", $_POST, "crear");
            return;
        }

        $descripcion = $_POST["descripcion"];
        ($descripcion == "") ? $descripcion = "Sin descripción" : $descripcion = $_POST["descripcion"];

        $data = array(
            "nombre" => $_POST["nombre"],
            "descripcion" => $descripcion,
            "imagen" => $imagen[0],
            "precio" => $_POST["precio"],
            "disponibilidad" => $_POST["disponibilidad"],
            "categoria" => $_POST["categoria"]
        );

        $id = $productModel->insert_product($data);
        if ($id) {

            for ($i = 1; $i < count($imagen); $i++) {
                $imagenData = array(
                    "imagen" => $imagen[$i],
                    "producto_id" => $id
                );
                $productModel->insert_image($imagenData);
            }

            // Insertar tallas
            foreach ($selectedSizes as $size) {
                $sizeData = array(
                    "talla" => $size,
                    "producto_id" => $id
                );
                $productModel->insert_size($sizeData);
            }

            // Insertar colores
            foreach ($selectedColors as $color) {
                $colorData = array(
                    "color" => $color,
                    "producto_id" => $id
                );
                $productModel->insert_color($colorData);
            }
            $this->index("Producto ingresado correctamente");
        } else {
            $this->index(false, null, "Error al ingresar el producto", $_POST, "crear");
        }
    }

    public function remove()
    {
        $productModel = new Product_model($this->conn);
        $product = $productModel->remove_product($this->id);

        if ($product) {
            $this->index("Producto eliminado correctamente");
        } else {
            $this->index(false, null, "Error al eliminar el producto", $_POST, "eliminar");
        }
    }

    public function json_producto()
    {
        $id = $this->id;
        $productoModelo = new Product_model($this->conn);
        $producto = $productoModelo->get_product_by_id_all($id);

        if ($producto) {
            echo json_encode(["error" => false, "producto" => $producto]);
        } else {
            echo json_encode(["error" => true, "mensaje" => "No se encontro el producto"]);
        }
    }

    public function details()
    {
        $productModel = new Product_model($this->conn);
        $product = $productModel->get_product_by_id($this->id);
        $imagesProduct = $productModel->get_images_product($this->id);
        $sizesProduct = $productModel->get_sizes_product($this->id);
        $colorsProduct = $productModel->get_colors_product($this->id);

        if (!$product) {
            $this->index(false, null, "Ese producto no existe", $_POST, "detalles");
            return;
        }

        load_view(
            "products",
            "details",
            [
                "producto" => $product,
                "imagenes" => $imagesProduct,
                "tallas" => $sizesProduct,
                "colores" => $colorsProduct
            ]
        );
    }
}
