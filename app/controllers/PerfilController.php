<?php

require_once("app/database/Connection.php");

class PerfilController
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
        $search = $userModel->search_by_id($_SESSION["user"]["id"]);

        load_view(
            "perfil",
            "index",
            [
                "usuarios" => $search,
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

    public function edit_profile_picture()
    {
        $userModel = new User_model($this->conn);

        if (isset($_FILES["pictureProfile"]) && $_FILES["pictureProfile"]["error"] === UPLOAD_ERR_OK) {
            $nombreArchivo = $_FILES["pictureProfile"]["name"];
            $imagenTemporal = $_FILES["pictureProfile"]["tmp_name"];
            $archivo = file_get_contents($imagenTemporal);
        } else {
            $archivo = null;
        }

        $update = $userModel->update_picture_profile($archivo, $_SESSION["user"]["id"]);

        if ($update) {
            $_SESSION["user"]["perfil"] = $archivo; //Actualizar imagen en la session actual
            echo json_encode(["success" => "Imagen actualizada correctamente"]);
        } else {
            echo json_encode(["error" => "Error al actualizar la imagen de perfil"]);
        }
    }
}
