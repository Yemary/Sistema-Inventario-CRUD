<?php include 'conexion.php'; ?>
<?php
$mensaje = "";

// Cargar datos para editar
if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = mysqli_query($conexion, $sql);
    $producto = mysqli_fetch_assoc($result);
}

// Guardar cambios
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = intval($_POST['id']);
    $nombre = mysqli_real_escape_string($conexion, trim($_POST['nombre']));
    $precio = floatval($_POST['precio']);
    $stock = intval($_POST['stock']);
    $categoria = mysqli_real_escape_string($conexion, trim($_POST['categoria']));

    $sql = "UPDATE productos 
            SET nombre='$nombre', precio=$precio, stock=$stock, categoria='$categoria' 
            WHERE id = $id";

    if(mysqli_query($conexion, $sql)){
        $mensaje = "<p style='color:green;'>✅ Producto actualizado correctamente. <a href='listar.php'>Volver al listado</a></p>";
        // Volver a cargar datos actualizados
        $result = mysqli_query($conexion, "SELECT * FROM productos WHERE id = $id");
        $producto = mysqli_fetch_assoc($result);
    } else {
        $mensaje = "<p style='color:red;'>❌ Error al actualizar: " . mysqli_error($conexion) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <style>
        nav { margin-bottom: 15px; padding: 10px; background: #f0f0f0; }
    </style>
</head>
<body>

<!-- Menú de navegación -->
<nav>
    <a href="registrar.php">Registrar nuevo producto</a> |
    <a href="listar.php">Ver listado completo</a> |
    <a href="calcular_stock.php">Resumen de inventario</a>
</nav>

    <h2>Editar Datos del Producto</h2>
    <?= $mensaje ?>

    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= $producto['id'] ?>">

        <label>Nombre del producto:</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required><br><br>

        <label>Precio (RD$):</label><br>
        <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required><br><br>

        <label>Cantidad en stock:</label><br>
        <input type="number" name="stock" value="<?= $producto['stock'] ?>" required min="0"><br><br>

        <label>Categoría:</label><br>
        <input type="text" name="categoria" value="<?= htmlspecialchars($producto['categoria']) ?>" required><br><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>