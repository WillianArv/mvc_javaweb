<?php
# Conexión al base de datos
require_once("app/database/Connection.php");


class IndexController
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
        $productModel = new Product_model($this->conn);
        $product = $productModel->consult_products();

        load_view(
            "Index",
            "index",
            [
                "productos" => $product
            ]
        );
    }
}
