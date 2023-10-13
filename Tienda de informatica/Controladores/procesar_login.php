<?php
require 'conexion.php';
require '../php/usuario.php';

// Obtiene una instancia de PDO usando la función conexion()
$conexion = conexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar envio de datos del formulario
    if (isset($_POST['usuario_usuario']) && isset($_POST['usuario_clave'])) {
        // Obtenemos el usuario y la contraseña del formulario
        $usuario = $_POST['usuario_usuario'];
        $hash_clave = $_POST['usuario_clave']; // Cambio de nombre a $hash_clave

        // Consulta para verificar los datos del usuario
        $sql = "SELECT usuario_id, usuario_clave FROM usuario WHERE usuario_usuario = ?";
        $stmt = $conexion->prepare($sql);
        if ($stmt) {
            $stmt->execute([$usuario]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                // Verificar la contraseña
                if (password_verify($hash_clave, $resultado['usuario_clave'])) { // Cambio de nombre aca
                    // Inicio de sesión exitoso
                    session_start();
                    $_SESSION['usuario_id'] = $resultado['usuario_id'];
                    header("Location: ../Front/home.php"); // Redirigir a la página de inicio después de iniciar sesión
                    exit(); // Salir para evitar que se siga ejecutando el código
                } else {
                    // Error de inicio de sesión
                    $mensaje_error = "Contraseña incorrecta.";
                }
            } else {
                // El usuario no existe en la base de datos
                $mensaje_error = "El usuario no existe.";
            }
        } else {
            // Error en la preparación de la consulta SQL
            $mensaje_error = "Error en la consulta SQL.";
        }
    } else {
        // Datos de formulario no proporcionados
        $mensaje_error = "Por favor, complete todos los campos.";
    }
}
?>