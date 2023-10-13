<?php
require_once '../Controladores/conexion.php';
require_once 'usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['usuario_nombre'];
    $apellido = $_POST['usuario_apellido'];
    $usuario = $_POST['usuario_usuario'];
    $email = $_POST['usuario_email'];
    $clave1 = $_POST['usuario_clave_1'];
    $clave2 = $_POST['usuario_clave_2'];

    // Verificar si las contraseñas coinciden
    if ($clave1 !== $clave2) {
        $mensaje_error = "Las contraseñas no coinciden";
    } else {
        // Creamos un nuevo objeto Usuario
        $nuevoUsuario = new Usuario($nombre, $apellido, $usuario, $email, $clave1);

        // Guardar usuario en la base de datos utilizando PDO
        try {
            $conexion = conexion(); // Obtenemos la conexión desde el archivo conexion.php
            $hash_clave = password_hash($clave1, PASSWORD_DEFAULT); // Ciframos la contraseña

            // Consulta SQL para insertar el usuario
            $sql = "INSERT INTO usuario (usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);

            if ($stmt) {
                $stmt->execute([$nombre, $apellido, $usuario, $hash_clave, $email]);

                // Verificamos si la inserción fue exitosa
                if ($stmt->rowCount() > 0) {
                    $mensaje_exito = "¡Usuario registrado con éxito!";
                } else {
                    $mensaje_error = "Hubo un error al registrar el usuario.";
                }
            } else {
                $mensaje_error = "Error en la preparación de la consulta SQL.";
            }
        } catch (PDOException $e) {
            $mensaje_error = "Error al registrar el usuario: " . $e->getMessage();
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
    <link rel="stylesheet"  href="../estilos/registro.css">
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
