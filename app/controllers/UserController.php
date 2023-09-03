<?php
@session_start();
require_once("app/database/Connection.php");


class UserController
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
        $userModel = new User_model($this->conn);
        $users = $userModel->get_all_users();
        load_view(
            "usuarios",
            "index",
            [
                "usuarios" => $users,
                "errores_validacion" => $errores_validacion,
                "error" => $error,
                "form_data" => $form_data,
                "accion" => $accion
            ]
        );

        if ($exito) {
            show_message("ÉXITO", $exito, "success", url("/user"));
        }
        if ($error) {
            show_message("ERROR", $error, "warning", url("/user"));
        }
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function remove()
    {
        $userModel = new User_model($this->conn);
        $search = $userModel->search_by_id($this->id);

        if (!$search) {
            $this->index(false, null, "Ese usuario no existe", null, "eliminar");
            return;
        }

        $id = $userModel->remove_user($this->id);
        if ($id) {
            $this->index("Usuario eliminado correctamente");
        } else {
            $this->index(false, null, "Error al eliminar el usuario", $_POST, "eliminar");
        }
    }
}
