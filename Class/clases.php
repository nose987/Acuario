<?php
include 'conexion.php'; 
$conn = new Conexion();
class ValidarUsuario {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion(); 
    }

    public function registrar($nombre, $correo, $contrasena, $pk_rol) {
        
        $sql = "INSERT INTO usuarios (nombre, correo, contrasena, pk_rol) VALUES ('$nombre', '$correo', '$contrasena', '$pk_rol')";

        if ($this->conexion->query($sql) === TRUE) {
            return true; 
        } else {
            return false; 
        }
    }

    public function iniciarSesion($correo, $contrasena) {
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            return $resultado->fetch_assoc(); 
        }
        return false; 
    }
}
?>
