<?php include 'conexion.php'; ?>
<?php
$mensaje = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = mysqli_real_escape_string($conexion, trim($_POST['nombre']));
    $precio = floatval($_POST['precio']);
    $stock = intval($_POST['stock']);
    $categoria = mysqli_real_escape_string($conexion, trim($_POST['categoria']));

    if(!empty($nombre) && !empty($precio) && !empty($stock) && !empty($categoria)){
        $sql = "INSERT INTO productos (nombre, precio, stock, categoria) 
                VALUES ('$nombre', $precio, $stock, '$categoria')";
        
        if(mysqli_query($conexion, $sql)){
            $mensaje = "<p style='color:green;'>✅ Producto registrado correctamente. <a href='listar.php'>Ver listado</a></p>";
        } else {
            $mensaje = "<p style='color:red;'>❌ Error al registrar: " . mysqli_error($conexion) . "</p>";
        }
    } else {
        $mensaje = "<p style='color:red;'>⚠️ Todos los campos son obligatorios</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
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

    <h2>Formulario de Registro de Productos</h2>
    <?= $mensaje ?>

    <form method="POST" action="">
        <label>Nombre del producto:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Precio (RD$):</label><br>
        <input type="number" step="0.01" name="precio" required min="0.01"><br><br>

        <label>Cantidad en stock:</label><br>
        <input type="number" name="stock" required min="0"><br><br>

        <label>Categoría:</label><br>
        <input type="text" name="categoria" required><br><br>

        <button type="submit">Guardar Producto</button>
    </form>
</body>
</html>