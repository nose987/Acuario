<?php

class Conexion {
    public static function conectar() {
        $servidor = "localhost";
        $usuario = "root";
        $contraseña = "";
        $nom_base_datos = "acuario";

        $conectar = new mysqli($servidor, $usuario, $contraseña, $nom_base_datos);

        if ($conectar->connect_error) {
            die("Error de conexión: " . $conectar->connect_error);
        }

        return $conectar;
    }
}
?>
