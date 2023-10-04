<?php

class Usuario {
    private $nombre;
    private $apellido;
    private $usuario;
    private $email;
    private $password;

    public function __construct($nombre, $apellido, $usuario, $email, $password) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->usuario = $usuario;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    // Getters para acceder a los datos del usuario
    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getEmail() {
        return $this->email;
    }

    // Método para verificar la contraseña
    public function verificarPassword($password) {
        return password_verify($password, $this->password);
    }
}

?>
