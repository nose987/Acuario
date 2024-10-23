<?php
class conexion extends mysqli {
    function __construct() {
        parent::__construct("localhost", "root", "", "acuario");
        
        if ($this->connect_error) {
            die("Conexión fallida: " . $this->connect_error);
        }
    }
}
?>
