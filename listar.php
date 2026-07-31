<?php
$conn = new mysqli("localhost", "root", "", "inventario_db");
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

$sql = "SELECT * FROM productos ORDER BY nombre ASC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
</head>
<body>
    <h2>Listado de Productos en Inventario</h2>

    <?php if ($resultado->num_rows > 0): ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoría</th>
        </tr>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?= $fila['id'] ?></td>
            <td><?= $fila['nombre'] ?></td>
            <td>$<?= number_format($fila['precio'], 2) ?></td>
            <td><?= $fila['stock'] ?></td>
            <td><?= $fila['categoria'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>No hay productos registrados aún</p>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>
</html>