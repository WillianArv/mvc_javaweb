<?php

class Product_model
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function consult_products()
    {
        $sql = "SELECT p.id AS 'id', p.nombre AS 'nombre', p.descripcion AS 'descripcion', p.imagen_principal AS 'imagen', p.precio AS 'precio', p.disponibilidad AS 'disponibilidad', c.nombre AS 'categoria' FROM productos p JOIN categorias c ON p.categoria_id = c.id";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_product_by_id($id)
    {
        $sql = "SELECT p.id AS 'id', p.nombre AS 'nombre', p.descripcion AS 'descripcion', p.imagen_principal AS 'imagen', p.precio AS 'precio', p.disponibilidad AS 'disponibilidad', c.nombre AS 'categoria' FROM productos p JOIN categorias c ON p.categoria_id = c.id WHERE p.id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_assoc();
    }

    public function search_by_name_product($nombre)
    {
        $sql = "SELECT * FROM productos WHERE nombre=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $nombre);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_assoc();
    }

    public function insert_product($data)
    {
        $sql = "INSERT INTO productos (nombre, descripcion, imagen_principal, precio, disponibilidad, categoria_id) 
                VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $data["nombre"], $data["descripcion"], $data["imagen"], $data["precio"], $data["disponibilidad"], $data["categoria"]);
        mysqli_stmt_execute($stmt);
        return $stmt->insert_id;
    }

    public function insert_image($data)
    {
        $sql = "INSERT INTO imagenes_producto (ruta, producto_id) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "si", $data["imagen"], $data["producto_id"]);
        mysqli_stmt_execute($stmt);
    }

    public function insert_size($data)
    {
        $sql = "INSERT INTO tallas_producto (talla, producto_id) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "si", $data["talla"], $data["producto_id"]);
        mysqli_stmt_execute($stmt);
    }

    public function insert_color($data)
    {
        $sql = "INSERT INTO colores_producto (color, producto_id) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "si", $data["color"], $data["producto_id"]);
        mysqli_stmt_execute($stmt);
    }

    public function remove_product($id)
    {
        $sql = "DELETE FROM productos WHERE id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        return $stmt->affected_rows;
    }

    public function update_product($data)
    {
        $sql = "UPDATE
        productos
      SET
        nombre = ?,
        descripcion = ?,
        imagen_principal = ?,
        precio = ?,
        color = ?,
        disponibilidad = ?,
        categoria_id = ?
      WHERE id = ?;";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "sssdsiii", $data["nombre"], $data["descripcion"], $data["imagen"], $data["precio"], $data["color"], $data["disponibilidad"], $data["categoria"], $data["id"]);
        mysqli_stmt_execute($stmt);
        return $stmt->affected_rows;
    }

    public function get_product_by_id_all($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function get_images_product($id)
    {
        $sql = "SELECT ruta FROM imagenes_producto WHERE producto_id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_sizes_product($id)
    {
        $sql = "SELECT talla FROM tallas_producto WHERE producto_id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function get_colors_product($id)
    {
        $sql = "SELECT color FROM colores_producto WHERE producto_id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
