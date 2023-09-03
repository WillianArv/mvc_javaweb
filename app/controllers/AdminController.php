<?php
# Requerir la conexión a la base de datos
require_once("app/database/Connection.php");

class AdminController
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
        check_role("admin");
        load_view(
            "admin",
            "index"
        );
    }
}
