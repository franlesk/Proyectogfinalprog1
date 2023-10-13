

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Informática - Inicio</title>
    <link rel="stylesheet"  href="Estilos/navbar.css">
</head>
<body>
    <header>
        <h1>Tienda de Informática</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="categorias.php">Categorías</a></li>
                <li><a href="carrito.php">Carrito de Compras</a></li>
                <li><a href="./php/perfil.php">Mi perfil</a></li>
                <li><button onclick="confirmarCierreSesion()">Cerrar Sesión</button></li>
            </ul>
            <script>
                function confirmarCierreSesion(){
                  let confirmar = confirm("¿Desea cerrar sesión?");
                  console.log("Confirmar:", confirmar);
                  if(confirmar){

                   window.location.href ="index.php";
                      }
             }
            </script>
        </nav>
    </header>
    
    <main>
        <section>
            <h2>Bienvenido a nuestra tienda de informática</h2>
            <p>Descubre una amplia gama de productos y servicios informáticos de alta calidad.</p>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2023 Tienda de Informática</p>
    </footer>
</body>
</html>
