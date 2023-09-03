<?php
@session_start();
require_once("app/database/Connection.php");


class RegisterController
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
        load_view("Register", null, [], false, false);
    }

    public function insert()
    {
        $userModel = new User_model($this->conn);
        $search = $userModel->search_by_email($_POST["email"]);

        if ($search) {
            echo json_encode(["error" => "El usuario ya existe"]);
            return;
        }

        $firstname = $_POST["firstaname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        date_default_timezone_set('America/El_Salvador');
        $fechaHoraActual = date('Y-m-d H:i:s');

        $data = [
            "name" => $firstname,
            "lastname" => $lastname,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "fecha_registro" => $fechaHoraActual,
            "rol" => "usuario"
        ];

        $id = $userModel->insert_user($data);

        if ($id)
            echo json_encode(["success" => "Usuario creado correctamente"]);
        else
            echo json_encode(["error" => "Error al crear el usuario"]);
    }
}
