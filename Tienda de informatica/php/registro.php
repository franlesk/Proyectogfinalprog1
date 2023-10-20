<?php
require_once '../Controladores/conexion.php';
require_once 'usuario.php';
require_once 'repositorio.php';
require_once '../Controladores/verificar_datos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiar_cadena($_POST['usuario_nombre']);
    $apellido = limpiar_cadena($_POST['usuario_apellido']);
    $usuario = limpiar_cadena($_POST['usuario_usuario']);
    $email = limpiar_cadena($_POST['usuario_email']);
    $clave1 = limpiar_cadena($_POST['usuario_clave_1']);
    $clave2 = limpiar_cadena($_POST['usuario_clave_2']);


    if ($clave1 !== $clave2) {
        $mensaje_error = "Las contraseñas no coinciden";
    } else {
        $conexion = conexion(); // Obtenemos la conexión desde el archivo conexion.php
        $repositorio = new Repositorio($conexion);

        $registrado = $repositorio->registrarUsuario($nombre, $apellido, $usuario, $clave1, $email);

        if ($registrado) {
            $mensaje_exito = "¡Usuario registrado con éxito!";
        } else {
            $mensaje_error = "Hubo un error al registrar el usuario.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Informática - Registro</title>
    <link rel="stylesheet"  href="../Front/estilos/registro.css">
</head>
<body>


    <main>
        <section class="formulario">
            <h2>Registro de Nuevos Usuarios:</h2>
            <form method="post" action="registro.php">
                
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="usuario_nombre" placeholder="Ingrese su nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="usuario_apellido" placeholder="Ingrese su apellido" required>

                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario_usuario" placeholder="Ingrese un usuario" required>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="usuario_email" placeholder="Ingrese su email" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="usuario_clave_1" placeholder="Ingrese una contraseña" required>

                <label for="confirm_password">Repita su contraseña:</label>
                <input type="password" id="confirm_password" name="usuario_clave_2" placeholder="Repita su contraseña" required>

                <button type="submit">Registrarse</button>

                <?php
                     if (isset($mensaje_exito)) {
                      echo '<p style="color: green;">' . $mensaje_exito . '</p>';
                      }
                     if (isset($mensaje_error)) {
                    echo '<p style="color: red;">' . $mensaje_error . '</p>';
                    }
                 ?>
            </form>
            
            <form action="../Front/index.php" method="GET">
            <button type="submit">Volver al inicio</button>
            </form>
        </section>
    </main>
</body>
</html>
