<?php
class Repositorio {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

public function obtenerUsuarioPorID($usuarioID) {
    $sql = "SELECT * FROM usuario WHERE usuario_id = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute([$usuarioID]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        return new Usuario(
            $resultado['usuario_nombre'],
            $resultado['usuario_apellido'],
            $resultado['usuario_usuario'],
            $resultado['usuario_email'],
            $resultado['usuario_clave']
        );
    } else {
        return null; // Retorna null si el usuario no se encuentra
    }
}





}

?>