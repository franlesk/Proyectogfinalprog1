<?php
require_once 'Carrito.php';

session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = new Carrito();
}

$carrito = $_SESSION['carrito'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $carrito->agregarProducto($id, $nombre, $precio, $cantidad);
    } elseif (isset($_POST['eliminar'])) {
        $id = $_POST['eliminar'];
        $carrito->eliminarProducto($id);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Resto de etiquetas head -->
</head>
<body>
    <!-- Resto del contenido HTML -->
    
    <main>
        <h2>Carrito de Compras</h2>
        <table>
            <!-- Encabezados de la tabla -->
            <tbody>
                <?php foreach ($carrito->obtenerProductos() as $id => $producto) : ?>
                    <tr>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td>$<?php echo $producto['precio']; ?></td>
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td>$<?php echo $producto['precio'] * $producto['cantidad']; ?></td>
                        <td>
                            <form method="post" action="carrito.php">
                                <input type="hidden" name="eliminar" value="<?php echo $id; ?>">
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="total">
            <p>Total: $<?php echo $carrito->calcularTotal(); ?></p>
            <a href="checkout.php">Finalizar Compra</a>
        </div>
    </main>
    
    <!-- Resto del contenido HTML -->
</body>
</html>
