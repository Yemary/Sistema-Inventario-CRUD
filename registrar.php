<?php
$conn = new mysqli("localhost", "root", "", "inventario_db");
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

$mensaje = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = trim($_POST['nombre']);
    $precio = trim($_POST['precio']);
    $stock = trim($_POST['stock']);
    $categoria = trim($_POST['categoria']);

    if(!empty($nombre) && !empty($precio) && !empty($stock) && !empty($categoria)){
        $sql = "INSERT INTO productos (nombre, precio, stock, categoria) 
                VALUES ('$nombre', '$precio', '$stock', '$categoria')";
        
        if($conn->query($sql)){
            $mensaje = "<p style='color:green;'>✅ Producto registrado correctamente</p>";
        } else {
            $mensaje = "<p style='color:red;'>❌ Error al registrar: " . $conn->error . "</p>";
        }
    } else {
        $mensaje = "<p style='color:red;'>⚠️ Todos los campos son obligatorios</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
</head>
<body>
    <h2>Formulario de Registro de Productos</h2>
    <?= $mensaje ?>

    <form method="POST" action="">
        <label>Nombre del producto:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Precio ($):</label><br>
        <input type="number" step="0.01" name="precio" required><br><br>

        <label>Cantidad en stock:</label><br>
        <input type="number" name="stock" required min="0"><br><br>

        <label>Categoría:</label><br>
        <input type="text" name="categoria" required><br><br>

        <button type="submit">Guardar Producto</button>
    </form>
</body>
</html>