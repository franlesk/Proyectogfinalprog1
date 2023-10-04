<?php
function conexion() {
    $host = "localhost";
    $nombre_bd = "ventas";
    $usuario = "root";
    $usuario_clave = "";

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$nombre_bd", $usuario, $usuario_clave);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

?>

