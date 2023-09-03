<?php
# Requerir la conexión a la base de datos
require("app/database/Connection.php");


class CarritoController
{
    private $id;
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }


    public function set_id($id)
    {
        $this->id = $id;
    }


    public function index()
    {
        load_view(
            "Carrito",
            "index",
            []
        );
    }

    public function anadir_producto()
    {
        $id_producto = $_POST["id_producto"];
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $imagen = $_POST["imagen"];
        $cantidad = $_POST["cantidad"];
        $sumar = $_POST["sumar"];

        store_product_in_cart($id_producto, $cantidad, $imagen, $nombre, $precio, $sumar);

        echo json_encode([
            "exito" => true,
            "mensaje" => "Producto añadido al carrito."
        ]);
    }


    public function actualizar_cantidad()
    {
        $id_producto = $_POST["id_producto"];
        $cantidad = $_POST["cantidad"];

        $productoModelo = new Product_model($this->conn);
        $producto = $productoModelo->get_product_by_id_all($id_producto);

        if (!$producto) {
            echo json_encode([
                "error" => true,
                "mensaje" => "El producto no existe."
            ]);
            return;
        }

        if ($producto['disponibilidad'] < $cantidad) {
            echo json_encode([
                "error" => true,
                "mensaje" => "No hay suficientes productos en existencia."
            ]);
            return;
        }

        store_product_in_cart($id_producto, $cantidad, "", "", "", false);

        echo json_encode([
            "exito" => true,
            "mensaje" => "Cantidad actualizada."
        ]);
    }

    public function quitar_producto()
    {
        remove_product_for_cart($this->id);
        $this->index();
    }
}
