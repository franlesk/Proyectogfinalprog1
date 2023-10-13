<nav>
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="productos.php">Productos</a></li>
        <li><a href="categorias.php">Categorías</a></li>
        <li><a href="carrito.php">Carrito de Compras</a></li>
        <li><a href="./php/perfil.php">Mi perfil</a></li>
        <li><button onclick="confirmarCierreSesion()">Cerrar Sesión</button></li>
    </ul>
</nav>

<script>
    function confirmarCierreSesion(){
        let confirmar = confirm("¿Desea cerrar sesión?");
        console.log("Confirmar:", confirmar);
        if(confirmar){
            window.location.href ="index.php";
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