<?php
include 'conexion.php';

class Usuario {
    private $conn;

    public function __construct() {
        $this->conn = new Conexion();
    }

    public function registrar($nombre, $correo, $contrasena, $pk_rol) {
        $sql = "INSERT INTO usuarios (nombre, correo, contrasena, pk_rol) VALUES ('$nombre', '$correo', '$contrasena', '$pk_rol')";
        return $this->conn->query($sql);
    }

    public function iniciarSesion($correo, $contrasena) {
        $sql = "SELECT * FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena'";
        $resultado = $this->conn->query($sql);
        return $resultado->num_rows > 0; // Retorna true si el usuario existe
    }
}
?>
