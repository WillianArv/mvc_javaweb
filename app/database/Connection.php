<?php

class Connection
{

    private $host;
    private $usuario;
    private $contrasena;
    private $base_datos;
    private $conexion;

    public function __construct($host, $usuario, $contrasena, $base_datos)
    {
        $this->host = $host;
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
        $this->base_datos = $base_datos;

        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->base_datos);

        if ($this->conexion->connect_errno) {
            echo "Error al conectarse a MySQL: " . $this->conexion->connect_error;
            exit();
        }
    }

    public function getConnection()
    {
        return $this->conexion;
    }

    public function __destruct()
    {
        $this->conexion->close();
    }
}


if (!isset($_ENV['MYSQL_HOST']) || !isset($_ENV['MYSQL_USER']) || !isset($_ENV['MYSQL_DATABASE'])) {
    echo "No se han configurado las variables de entorno para la conexión a la base de datos";
    echo " <a href='/instalador'>Configurar</a>";
    exit();
} else {
    $conexionBD = new Connection(
        $_ENV['MYSQL_HOST'],
        $_ENV['MYSQL_USER'],
        $_ENV['MYSQL_PASSWORD'],
        $_ENV['MYSQL_DATABASE']
    );

    // Establecer la conexión a la base de datos
    $conn = $conexionBD->getConnection();
}
