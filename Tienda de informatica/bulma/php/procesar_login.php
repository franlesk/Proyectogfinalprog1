<?php
// Incluye los archivos necesarios
require_once 'usuario.php';
require_once 'conexion.php';

// Obtiene una instancia de PDO usando la función conexion()
$conexion = conexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene el usuario y la contraseña del formulario
    $usuario = $_POST['usuario_usuario'];
    $usuario_clave = $_POST['usuario_clave'];

    // Consulta preparada para verificar las credenciales del usuario
    $sql = "SELECT usuario_id, usuario_clave FROM usuario WHERE usuario_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$usuario]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar la contraseña
    if ($resultado && password_verify($usuario_clave, $resultado['usuario_clave'])) {
        // Inicio de sesión exitoso
        session_start();
        $_SESSION['usuario_id'] = $resultado['usuario_id'];
        header("Location: inicio.php"); // Redirigir a la página de inicio después de iniciar sesión
        exit(); // Salir para evitar que se siga ejecutando el código
    } else {
        // Error de inicio de sesión
        $mensaje_error = "Credenciales incorrectas.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Resto de etiquetas head -->
</head>
<body>
    <main>
        <section>
            <h2>Iniciar Sesión</h2>
            <form method="post" action="../home.php">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario_usuario" required>

                <label for="usuario_clave">Contraseña:</label>
                <input type="password" id="usuario_clave" name="usuario_clave" required>

                <button type="submit">Iniciar Sesión</button>

                <?php
                if (isset($mensaje_error)) {
                    echo '<p style="color: red;">' . $mensaje_error . '</p>';
                }
                ?>
            </form>
        </section>
    </main>
</body>
</html>
