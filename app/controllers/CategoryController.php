<?php
# Conexión al base de datos
require_once("app/database/Connection.php");

class CategoryController
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
        $categoryModel = new Category_model($this->conn);
        $categorias = $categoryModel->consult_category();

        load_view(
            "Categorys",
            "index",
            [
                "categorias" => $categorias,
                "errores_validacion" => $errores_validacion,
                "error" => $error,
                "form_data" => $form_data,
                "accion" => $accion
            ]
        );

        if ($exito) {
            show_message("ÉXITO", $exito, "success", url("/category"));
        }
        if ($error) {
            show_message("ERROR", $error, "warning", url("/category"));
        }
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function insert()
    {
        $categoryModel = new Category_model($this->conn);

        $name = $_POST["nombre"];
        $description = $_POST["descripcion"];

        $category = $categoryModel->search_category_by_name($name);
        if ($category) {
            $this->index(false, null, "Ya existe una categoría con ese nombre", $_POST, "crear");
            return;
        }

        ($description == "") ? $description = "Sin descripción" : $description = $_POST["descripcion"];

        $data = [
            'nombre' => $name,
            'descripcion' => $description
        ];

        $id = $categoryModel->insert_category($data);

        if ($id) {
            $this->index("Categoría creada correctamente");
        } else {
            $this->index(false, null, "Error al crear la categoría", $_POST, "crear");
        }
    }

    public function edit()
    {
        $categoryModel = new Category_model($this->conn);
        $category = $categoryModel->consult($this->id);

        if (!$category) {
            $this->index(false, null, "La categoría no existe", null, "editar");
            return;
        }
        $this->index(false, null, null, $category, "editar");
    }

    public function update()
    {
        $categoryModel = new Category_model($this->conn);
        $category = $categoryModel->consult($this->id);

        if (!$category) {
            $this->index(false, null, "La categoría no existe", null, "editar");
            return;
        }

        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];

        $categoryName = $categoryModel->search_category_by_name($nombre);
        if ($categoryName) {
            $categoryDescription = $categoryModel->search_category_description($nombre);
            if ($categoryDescription["descripcion"] == $descripcion) {
                $this->index(false, null, "Esa categoría ya existe", $_POST, "editar");
            } else {
                $update_description = $categoryModel->update_category_description($descripcion, $this->id);
                if ($update_description) {
                    $this->index("Descripción de la categoría actualizada correctamente");
                } else {
                    $this->index(false, null, "Esa categoría ya existe, elije otro nombre", $_POST, "editar");
                }
            }
        } else {

            $data = [
                "nombre" => $nombre,
                "descripcion" => $descripcion
            ];

            $update = $categoryModel->update_category($this->id, $data);

            if ($update) {
                $this->index("Categoría actualizada correctamente");
            } else {
                $this->index(false, null, "Error al actualizar la categoría", $_POST, "editar");
            }
        }
    }

    public function remove()
    {
        $categoryModel = new Category_model($this->conn);

        $verifyCategory = $categoryModel->check_category_in_products($this->id);
        if ($verifyCategory) {
            $this->index(false, null, "No se puede eliminar esa categoría, tiene productos relacionados", $_POST, "eliminar");
        } else {
            $category = $categoryModel->remove_category($this->id);

            if ($category) {
                $this->index("Categoría eliminada correctamente");
            } else {
                $this->index(false, null, "Error al eliminar la categoría", $_POST, "eliminar");
            }
        }
    }

    public function insert_second()
    {
        $categoryModel = new Category_model($this->conn);

        $name = $_POST["categoria"];
        $description = $_POST["descripcion"];

        $category = $categoryModel->search_category_by_name($name);
        if ($category) {
            $this->index(false, null, "Ya existe una categoría con ese nombre", $_POST, "crear");
            return;
        }

        ($description == "") ? $description = "Sin descripción" : $description = $_POST["descripcion"];

        $data = [
            'nombre' => $name,
            'descripcion' => $description
        ];

        $id = $categoryModel->insert_category($data);
        if ($id) {
            $category = $categoryModel->consult($id);
            if ($category) {
                echo json_encode($category); //Esta es la respuesta que retorna al insertar la categoría
            }
        } else {
            echo json_encode(["error" => "Error al crear la categoría"]);
        }
    }
}
