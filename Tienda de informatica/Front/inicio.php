<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // El usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: formulario_login.php");
    exit();
}

// El usuario ha iniciado sesión, mostrar el contenido protegido
echo "¡Bienvenido! Contenido protegido aquí.";
?>
