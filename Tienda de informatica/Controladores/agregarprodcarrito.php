<?php
require_once 'conexion.php'; 

public function agregarProductoAlCarritoDesdeSesion($producto_id, $cantidad) {
    // Conectamos a la base de datos
    $conexion = conexion();

    if ($conexion) {
        // INSERT del producto en la tabla compra_productos
        $sql = "INSERT INTO compra_productos (producto_id, cantidad_compra) VALUES (:producto_id, :cantidad)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Producto agregado al carrito exitosamente.";
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->errorInfo()[2];
        }

        // Cerrar la conexión a la base de datos
        $conexion = null;
    } else {
        echo "Error de conexión a la base de datos.";
    }
}