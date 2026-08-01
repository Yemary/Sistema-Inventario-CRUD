<?php include 'conexion.php'; ?>
<?php

$sql = "SELECT 
            COUNT(*) AS total_productos,
            SUM(stock) AS total_unidades,
            SUM(precio * stock) AS valor_total_inventario
        FROM productos";
$resultado = mysqli_query($conexion, $sql);
$resumen = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen y Cálculo de Stock</title>
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

    <h2>Resumen General del Inventario</h2>
    <p>Total de productos registrados: <strong><?= $resumen['total_productos'] ?? 0 ?></strong></p>
    <p>Total de unidades disponibles: <strong><?= $resumen['total_unidades'] ?? 0 ?></strong></p>
    <p>Valor total del inventario: <strong>RD$ <?= number_format($resumen['valor_total_inventario'] ?? 0, 2) ?></strong></p>
    
    <br>
    <a href="listar.php">← Volver al listado completo</a>
</body>
</html>