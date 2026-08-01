<?php include 'conexion.php'; ?>
<?php

$sql = "SELECT * FROM productos ORDER BY nombre ASC";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
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

    <h2>Listado de Productos en Inventario</h2>

    <?php if (mysqli_num_rows($resultado) > 0): ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
        <tr>
            <td><?= $fila['id'] ?></td>
            <td><?= htmlspecialchars($fila['nombre']) ?></td>
            <td>RD$ <?= number_format($fila['precio'], 2) ?></td>
            <td><?= $fila['stock'] ?></td>
            <td><?= htmlspecialchars($fila['categoria']) ?></td>
            <td>
                <a href='editar.php?id=<?= $fila['id'] ?>'>Editar</a> |
                <a href='eliminar.php?id=<?= $fila['id'] ?>' onclick='return confirm("¿Seguro que quieres borrar este producto?")'>Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>No hay productos registrados aún</p>
    <?php endif; ?>

</body>
</html>