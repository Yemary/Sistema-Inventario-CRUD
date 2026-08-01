<?php include 'conexion.php'; ?>
<?php

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = intval($_GET['id']);
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if(mysqli_stmt_execute($stmt)){
        header("Location: listar.php?mensaje=eliminado");
        exit;
    } else {
        echo "<p style='color:red;'>❌ Error al eliminar: " . mysqli_error($conexion) . "</p>";
    }
    mysqli_stmt_close($stmt);
} else {
    header("Location: listar.php");
    exit;
}
?>