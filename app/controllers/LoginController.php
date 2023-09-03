<?php
@session_start();
require_once("app/database/Connection.php");


class LoginController
{
    private $id;

    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function index()
    {
        load_view("Login", null, [], false, false);
    }

    public function login()
    {
        $usuarioModelo = new User_model($this->conn);
        $usuario = $usuarioModelo->search_by_email($_POST['email']);

        if (!$usuario) {
            echo json_encode(["error" => "El usuario no existe"]);
            return;
        }

        if (!password_verify($_POST['contraseña'], $usuario['contraseña'])) {
            echo json_encode(["error" => "Credenciales Incorrectas"]);
            return;
        }

        $_SESSION['user'] = $usuario;

        echo json_encode(
            [
                "success" => "Usuario logueado correctamente",
                "rol" => $usuario['tipo_usuario'],
            ]
        );
    }

    public function logout()
    {
        session_destroy();
        header("location:" . url("/"));
    }
}
