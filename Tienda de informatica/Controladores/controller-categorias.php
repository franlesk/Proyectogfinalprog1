<?php
require_once 'conexion.php';

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'todos';
$orden = isset($_GET['orden']) && ($_GET['orden'] === 'asc' || $_GET['orden'] === 'desc') ? $_GET['orden'] : '';

if ($categoria === 'todos') {
    $query = "SELECT * FROM producto ORDER BY producto_precio $orden";
} else {
    $query = "SELECT * FROM producto WHERE categoria_id = :categoria ORDER BY producto_precio $orden";
}

$conexion = conexion();
// Prepara la consulta
$stmt = $conexion->prepare($query);

if ($categoria !== 'todos') {
    // Asigna el valor al parámetro :categoria
    $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
}

// Ejecuta la consulta
$stmt->execute();

// Obtener el número de filas
$num_rows = $stmt->rowCount();

if ($num_rows > 0) {
    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Procesa cada fila
        echo '<div class="product">';
        echo '<img src="' . $fila['producto_foto'] . '" alt="' . $fila['producto_nombre'] . '">';
        echo '<p>' . $fila['producto_nombre'] . '</p>';
        echo '<p>' . "Precio: " . $fila['producto_precio'] . '</p>';
        echo '<p>' . "Stock: " . $fila['producto_stock'] . '</p>';
        echo '<button class="button-carrito">'. "Añadir al carrito" . '</button>';
        echo '</div>';
    }
} else {
    echo 'No se encontraron productos.';
}
?>