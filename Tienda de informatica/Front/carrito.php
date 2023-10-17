<?php
// Incluye el archivo de clases
require_once '../Controladores/conexion.php';
require '../php/clase_categoria.php';
require '../php/clase_producto.php';
require '../php/clase_carrito.php';

//session_start();
// Crear una instancia de Carrito
$carrito = new Carrito();

// Procesar la solicitud para agregar productos al carrito
if (isset($_POST['agregar_carrito'])) {
    $productoID = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    // Agregar el producto al carrito desde la base de datos (si está disponible)
    $carrito->agregarProductoAlCarritoDesdeSesion($productoID, $cantidad);
}

// Mostrar los productos en el carrito
$productosEnCarrito = $carrito->obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
   <link rel="stylesheet" href="..\Front\estilos\navbar.css">
   <link rel="stylesheet" href="..\Front\estilos\carrito.css">
</head>
<body>
<header>
   <?php 
   include 'navbar.php';
   ?>
</header>
<div id="container-carrito"> 
    <table>
        <thead>
            <tr>
                <th>Descripcion:</th>
                <th>Producto:</th>
                <th>Precio:</th>
                <th>Cantidad:</th>
                <th>Total:</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Dentro del bucle que muestra los productos en el carrito
            foreach ($productosEnCarrito as $productoCarrito) {
                    echo '<tr>';
                    echo '<td ><img class="foto_carrito" src="' . $productoCarrito['producto']->getProductoFoto() . '" alt="' .  '"></td>';
                    echo '<td>' . $productoCarrito['producto']->getProductoNombre() . '</td>';
                    echo '<td>$' . $productoCarrito['producto']->getProductoPrecio() . '</td>';
                    echo '<td>' . $productoCarrito['cantidad'] . '</td>';
                    echo '<td>$' . $productoCarrito['producto']->getProductoPrecio() * $productoCarrito['cantidad'] . '</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
    
    <div class="total">
        
        <p>Total: $<?php echo $carrito->calcularTotal(); ?></p>
        <a href="../php/vaciar_carrito.php" class="boton_vaciar_carrito">Vaciar Carrito</a>
        <a href="checkout.html">Finalizar Compra</a>
    
    </div>
    
<footer>
    <p>&copy; 2023 Tienda de Informática</p>
</footer>
</body>
</html>
