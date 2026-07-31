<?php
$conn = new mysqli("localhost", "root", "", "inventario_db");
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()){
        header("Location: listar.php?mensaje=eliminado");
        exit;
    } else {
        echo "<p style='color:red;'>❌ Error al eliminar: " . $conn->error . "</p>";
    }
    $stmt->close();
} else {
    header("Location: listar.php");
    exit;
}

$conn->close();
?>