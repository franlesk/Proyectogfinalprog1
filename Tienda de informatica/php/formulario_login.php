<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../estilos/login.css">
</head>
<body>
    <form action="procesar_login.php" method="POST">
        <h1>Iniciar Sesión</h1>
        <label for="usuario">Usuario:</label> 
        <input type="text" id="usuario" name="usuario_usuario" placeholder="Nombre de usuario" required><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="usuario_clave" placeholder="Contraseña" required><br><br>
        <button type="submit">Iniciar Sesión</button>
        <a href="registro.php">Registrate aqui</a>
    </form>
</body>
</html>
