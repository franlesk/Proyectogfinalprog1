<?php
require_once "../Controladores/conexion.php";
require_once "usuario.php";
require_once "repositorio.php";

// Iniciar la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['usuario_id'])) {
    $usuarioID = $_SESSION["usuario_id"];
    $conexion = conexion(); // Establecer la conexión aquí

    // Crear un objeto Repositorio con la conexión
    $repositorio = new Repositorio($conexion);

    $usuario = $repositorio->obtenerUsuarioPorID($usuarioID);

    if ($usuario) {
        echo "Nombre: " . $usuario->getNombre() . "<br>";
        echo "Apellido: " . $usuario->getApellido() . "<br>";
        echo "Usuario: " . $usuario->getUsuario() . "<br>";
        echo "Email: " . $usuario->getEmail() . "<br>";
    } else {
        echo "Usuario no encontrado.";
    }

    // Cierra la conexión después de usarla (opcional)
    $conexion = null;
} else {
    echo "Sesión no iniciada. Debes iniciar sesión primero.";
}
?>
