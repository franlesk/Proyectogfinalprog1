<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="Estilos/navbar.css">
    <link rel="stylesheet" href="Estilos/carrito.css">
</head>
<body>

<?php include 'navbar.php'; ?>
   
    
    <div id="container-carrito">
        <h2>Carrito de Compras</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td>Producto 1</td>
                    <td>$50.00</td>
                    <td>2</td>
                    <td>$100.00</td>
                </tr>
            
            </tbody>
        </table>
        
        <div class="total">
            <p>Total: $100.00</p>
            <a href="checkout.html">Finalizar Compra</a>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2023 Tienda de Informática</p>
    </footer>
</body>
</html>
