<?php

class Category_model
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function consult($id)
    {
        $sql = "SELECT id, nombre, descripcion FROM categorias WHERE id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_assoc();
    }

    public function check_category_in_products($id)
    {
        $sql = "SELECT * FROM categorias c JOIN productos p ON c.id= p.categoria_id WHERE c.id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_assoc();
    }

    public function consult_category()
    {
        $sql = "SELECT * FROM categorias";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert_category($data)
    {
        $sql = "INSERT INTO categorias(nombre, descripcion) VALUES(?,?)";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $data["nombre"], $data["descripcion"]);
        mysqli_stmt_execute($stmt);
        return  $stmt->insert_id;
    }

    public function search_category_by_name($name)
    {
        $sql = "SELECT * FROM categorias WHERE nombre=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_assoc();
    }

    public function search_category_description($name)
    {
        $sql = "SELECT nombre, descripcion FROM categorias WHERE nombre=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_assoc();
    }

    public function update_category($id, $data)
    {
        $sql = "UPDATE categorias SET nombre=?, descripcion=? WHERE id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $data["nombre"], $data["descripcion"], $id);
        mysqli_stmt_execute($stmt);
        return $stmt->affected_rows;
    }

    public function update_category_description($descripcion, $id)
    {
        $sql = "UPDATE categorias SET descripcion=? WHERE id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "si", $descripcion, $id);
        mysqli_stmt_execute($stmt);
        return $stmt->affected_rows;
    }

    public function remove_category($id)
    {
        $sql = "DELETE FROM categorias WHERE id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        return $stmt->affected_rows;
    }
}
