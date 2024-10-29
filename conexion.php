<?php
class Conexion {
    private $host = "localhost"; 
    private $usuario = "root"; 
    private $password = ""; 
    private $dbname = "acuario";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->usuario, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }
}
?>
