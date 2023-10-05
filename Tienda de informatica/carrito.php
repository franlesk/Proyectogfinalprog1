<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="estilos/estilos.css">
</head>
<body>
    <header>
        <h1>Tienda de Informática</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="categorias.php">Categorías</a></li>
                <li><a href="carrito.php">Carrito de Compras</a></li>
                <li><a href="php/registro.php">Registro</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
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
    </main>
    
    <footer>
        <p>&copy; 2023 Tienda de Informática</p>
    </footer>
</body>
</html>
