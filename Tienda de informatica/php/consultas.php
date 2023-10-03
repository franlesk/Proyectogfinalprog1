<?php
//esto hay que modificarlo porque al final use PDO en lugar de mysqli
$sql = "SELECT * FROM producto";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    // Procesar los resultados
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $fila['producto_id'] . "<br>";
        echo "Nombre: " . $fila['producto_nombre'] . "<br>";
        // Otras operaciones con los datos
    }
    mysqli_free_result($resultado); 
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}
mysqli_close($conexion);
?>