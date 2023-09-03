<?php
@session_start();
$role = $_SESSION['user']['tipo_usuario'] ?? 'usuario';
require_once 'app/views/layouts/navbars/' . $role . '.php';
