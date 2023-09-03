<?php
class User_model
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function search_by_email($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_assoc();
    }

    public function get_all_users()
    {
        $sql = "SELECT * FROM usuarios";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert_user($data)
    {
        $sql = "INSERT INTO usuarios (nombre, apellido, email, contraseña, fecha_registro,tipo_usuario) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $data["name"], $data["lastname"], $data["email"], $data["password"], $data["fecha_registro"], $data["rol"]);
        mysqli_stmt_execute($stmt);
        return $stmt->insert_id;
    }

    public function remove_user($id)
    {
        $sql = "DELETE FROM usuarios WHERE id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        return $stmt->affected_rows;
    }

    public function search_by_id($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_assoc();
    }

    public function update_picture_profile($imagen, $id)
    {
        $sql = "UPDATE usuarios SET perfil=? WHERE id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "si", $imagen, $id);
        mysqli_stmt_execute($stmt);
        return $stmt->affected_rows;
    }
}
