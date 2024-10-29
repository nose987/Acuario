<?php
class Conexion {
    private $servername = "localhost";
    private $username = "root"; // Cambia según tu configuración
    private $password = ""; // Cambia según tu configuración
    private $dbname = "acuario"; // Cambia según tu base de datos

    public function connect() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function query($sql) {
        $conn = $this->connect();
        return $conn->query($sql);
    }
}

class ValidarUsuario {
    public function registrar($nombres, $apaterno, $amaterno, $fk_area, 
        $fecha_nac, $genero, $direccion, $correo, $num_telefono, $contrasena, $pk_rol) {
        
        $conn = new Conexion();

        // Inserta el usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombres, apaterno, amaterno, fk_area, 
            fecha_nac, genero, direccion, correo, num_telefono, contrasena, pk_rol) 
            VALUES ('$nombres', '$apaterno', '$amaterno', '$fk_area', 
            '$fecha_nac', '$genero', '$direccion', '$correo', '$num_telefono', 
            '$contrasena', '$pk_rol')";

        return $conn->query($sql); // Devuelve true o false
    }
}
?>
