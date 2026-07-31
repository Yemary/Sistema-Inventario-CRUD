<?php
$conn = new mysqli("localhost", "root", "", "inventario_db");
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

$sql = "SELECT 
            COUNT(*) AS total_productos,
            SUM(stock) AS total_unidades,
            SUM(precio * stock) AS valor_total_inventario
        FROM productos";
$resultado = $conn->query($sql);
$resumen = $resultado->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen y Cálculo de Stock</title>
</head>
<body>
    <h2>Resumen General del Inventario</h2>
    <p>Total de productos registrados: <strong><?= $resumen['total_productos'] ?? 0 ?></strong></p>
    <p>Total de unidades disponibles: <strong><?= $resumen['total_unidades'] ?? 0 ?></strong></p>
    <p>Valor total del inventario: <strong>$<?= number_format($resumen['valor_total_inventario'] ?? 0, 2) ?></strong></p>
    
    <br>
    <a href="listar.php">← Volver al listado completo</a>
</body>
</html>