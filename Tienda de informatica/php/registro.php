<?php
require_once 'usuario.php';
require_once 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['usuario_nombre'];
    $apellido = $_POST['usuario_apellido'];
    $usuario = $_POST['usuario_usuario'];
    $email = $_POST['usuario_email'];
    $clave1 = $_POST['usuario_clave_1'];
    $clave2 = $_POST['usuario_clave_2'];

    // Verificar si las contraseñas coinciden
    if ($clave1 !== $clave2) {
        echo "Las contraseñas no coinciden";
    } else {
        // crear un nuevo objeto Usuario
        $nuevoUsuario = new Usuario($nombre, $apellido, $usuario, $email, $clave1);

        // Guardar usuario en la base de datos utilizando PDO
        try {
            $conexion = conexion(); // Obtenemos la conexión desde el archivo conexion.php
            $sql = "INSERT INTO usuario (usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$nombre, $apellido, $usuario, $clave1, $email]);

            // verificamos si es exitosa la conexion
            if ($stmt->rowCount() > 0) {
                $mensaje_exito = "¡Usuario registrado con éxito!";
            } else {
                $mensaje_error = "Hubo un error al registrar el usuario.";
            }
        } catch (PDOException $e) {
            echo "Error al registrar el usuario: " . $e->getMessage();
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
    <link rel="stylesheet"  href="../estilos/estilos.css">
</head>
<body>


    <main>
        <section>
            <h2>Registro de Nuevos Usuarios</h2>
            <form method="post" action="registro.php">
                
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="usuario_nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="usuario_apellido" required>

                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario_usuario" required>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="usuario_email" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="usuario_clave_1" required>

                <label for="confirm_password">Repita su contraseña:</label>
                <input type="password" id="confirm_password" name="usuario_clave_2" required>

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
            
            <form action="../index.php" method="GET">
            <button type="submit">Volver al inicio</button>
            </form>
        </section>
    </main>
</body>
</html>
