<?php
require_once '../Controladores/conexion.php';
require '../php/clase_carrito.php';

session_start();

// Crear una instancia de Carrito
$carrito = new Carrito();

foreach ($carrito->obtenerProductos() as $productoID => $producto) {
    $carrito->removerProducto($productoID);
}

// Redirigir de nuevo a la página del carrito
header('Location: ../Front/carrito.php');
?>
