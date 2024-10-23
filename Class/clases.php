<?php
include 'conexion.php'; 
class validarUsuario {
    private $conexion;

    public function __construct() {
        $this->conexion = new conexion();
    }
    
    public function registrar($nombre, $correo, $contrasena) {
        
        $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')";

        if ($this->conexion->query($sql) === TRUE) {
            return true; 
        } else {
            return false;
        }
    }
    
   // lo saqué de chat
    public function iniciarSesion($correo, $contrasena) {
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            
            if ($contrasena === $usuario['contrasena']) { // Comparar directamente
                return $usuario; // Retornar datos del usuario
            }
        }
        return false; // Usuario no válido
    }
}
?>
