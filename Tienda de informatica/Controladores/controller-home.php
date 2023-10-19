<?php
require_once 'conexion.php';

$query = "SELECT * FROM (SELECT * FROM producto ORDER BY RAND()) AS productos GROUP BY categoria_id";

$conexion = conexion();
// Prepara la consulta
$stmt = $conexion->prepare($query);

$stmt->execute();

// Obtener el número de filas
$num_rows = $stmt->rowCount();

if ($num_rows > 0) {
    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Procesa cada fila
        echo '<div class="product">';
        echo '<img src="' . $fila['producto_foto'] . '" alt="' . $fila['producto_nombre'] . '">';
        echo '<p>' . $fila['producto_nombre'] . '</p>';
        echo '<p>' . "Precio: $" . $fila['producto_precio'] . '</p>';
        echo '<p>' . "Stock: " . $fila['producto_stock'] . '</p>';
        echo '</div>';
    }
} else {
    echo 'No se encontraron productos.';
}
?>