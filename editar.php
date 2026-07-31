<?php
$conn = new mysqli("localhost", "root", "", "inventario_db");
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

$mensaje = "";

// Cargar datos para editar
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = $conn->query($sql);
    $producto = $result->fetch_assoc();
}

// Guardar cambios
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $precio = trim($_POST['precio']);
    $stock = trim($_POST['stock']);
    $categoria = trim($_POST['categoria']);

    $sql = "UPDATE productos 
            SET nombre='$nombre', precio='$precio', stock='$stock', categoria='$categoria' 
            WHERE id = $id";

    if($conn->query($sql)){
        $mensaje = "<p style='color:green;'>✅ Producto actualizado correctamente</p>";
        // Volver a cargar datos actualizados
        $result = $conn->query("SELECT * FROM productos WHERE id = $id");
        $producto = $result->fetch_assoc();
    } else {
        $mensaje = "<p style='color:red;'>❌ Error al actualizar: " . $conn->error . "</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Datos del Producto</h2>
    <?= $mensaje ?>

    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= $producto['id'] ?>">

        <label>Nombre del producto:</label><br>
        <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required><br><br>

        <label>Precio ($):</label><br>
        <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required><br><br>

        <label>Cantidad en stock:</label><br>
        <input type="number" name="stock" value="<?= $producto['stock'] ?>" required min="0"><br><br>

        <label>Categoría:</label><br>
        <input type="text" name="categoria" value="<?= $producto['categoria'] ?>" required><br><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>