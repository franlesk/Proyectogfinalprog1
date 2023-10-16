<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Informática</title>
    <!-- Agrega tus enlaces a archivos CSS y otros elementos del encabezado aquí -->
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
                <?php
                session_start(); 
                if (isset($_SESSION['usuario_id'])) {
                    // Si el usuario está iniciado sesión, muestra estos elementos del menú
                    echo '<li><a href="mostrar_perfil.php">Mi perfil</a></li>';
                    echo '<button onclick="confirmarCierreSesion()">Cerrar Sesión</button></li>';
                } else {
                    // Si el usuario no ha iniciado sesión, muestra estos elementos del menú
                    echo '<li><a href="../php/registro.php">Registro</a></li>';
                    echo '<li><a href="formulario_login.php">Inicia sesión</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>

<script>
    function confirmarCierreSesion(){
        let confirmar = confirm("¿Desea cerrar sesión?");
        console.log("Confirmar:", confirmar);
        if(confirmar){
            window.location.href ="cerrar_sesion.php";
        }
    }

    // Obtener la URL actual
    const currentPage = window.location.href;

    // Obtener todos los enlaces de la barra de navegación
    const navLinks = document.querySelectorAll('nav a');

    // Deshabilitar el enlace correspondiente a la página actual
    navLinks.forEach(link => {
        if (link.href === currentPage) {
            link.style.pointerEvents = 'none'; // Deshabilitar el enlace
            link.style.color = 'gray';  // Cambiar color del enlace deshabilitado
        }
    });
</script>


</body>
</html>
