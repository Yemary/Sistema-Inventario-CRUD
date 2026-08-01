<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$base_datos = "inventario_db";

$conexion = mysqli_connect($servidor, $usuario, $clave, $base_datos);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>