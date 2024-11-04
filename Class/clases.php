<?php
include_once 'conexion.php'; // Cambiar a include_once para evitar múltiples inclusiones

class OpcionesFormulario {
    private $conn;

    public function __construct() {
        $this->conn = new Conexion(); 
    }

    public function obtenerOpcionesAreas() {
        $sql = "SELECT pk_area, nombre FROM area";
        $result = $this->conn->query($sql);
        $opciones = "";

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $opciones .= "<option value='" . $row['pk_area'] . "'>" . $row['nombre'] . "</option>";
            }
        } else {
            $opciones = "<option value=''>No se encontraron áreas</option>";
        }

        return $opciones;
    }

    public function obtenerOpcionesRoles() {
        $sql = "SELECT pk_roles, roles FROM roles";
        $result = $this->conn->query($sql);
        $opciones = "";

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $opciones .= "<option value='" . $row['pk_roles'] . "'>" . $row['roles'] . "</option>";
            }
        } else {
            $opciones = "<option value=''>No se encontraron roles</option>";
        }

        return $opciones;
    }

    public function obtenerOpcionesEspecies() {
        $sql = "SELECT pk_especie, nombre FROM especie";
        $result = $this->conn->query($sql);
        $opciones = "";

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $opciones .= "<option value='" . $row['pk_especie'] . "'>" . $row['nombre'] . "</option>";
            }
        } else {
            $opciones = "<option value=''>No se encontraron especies</option>";
        }

        return $opciones;
    }
}

class ValidarUsuario {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conn;
    }

    // Método para registrar un usuario
    public function registrar($nombres, $apaterno, $amaterno, $fk_area, 
        $fecha_nac, $genero, $direccion, $correo, $num_telefono, $contrasena, $edad, $fk_roles) {

        // Verifica si el correo ya existe
        if ($this->correoExistente($correo)) {
            return "El correo ya está registrado.";
        }

        // Verifica si el rol es válido
        if (!$this->rolValido($fk_roles)) {
            return "El rol seleccionado no es válido.";
        }

        // Verifica si el área es válida
        if (!$this->areaValida($fk_area)) {
            return "El área seleccionada no es válida.";
        }

        // Inserta el nuevo usuario
        $sql = "INSERT INTO persona (nombre, apaterno, amaterno, correo, 
                fecha_nac, telefono, genero, direccion, contrasena, edad, fk_roles, fk_area) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepara la consulta
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return "Error al preparar la consulta: " . $this->conn->error;
        }

        // Enlaza los parámetros
        $stmt->bind_param("ssssssssssss", $nombres, $apaterno, $amaterno, $correo, 
            $fecha_nac, $num_telefono, $genero, $direccion, $contrasena, $edad, $fk_roles, $fk_area);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            return true; // Registro exitoso
        } else {
            return "Error al registrar el usuario: " . $stmt->error;
        }
    }

    // Función para verificar si el correo ya está registrado
    private function correoExistente($correo) {
        $query = "SELECT * FROM persona WHERE correo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Función para verificar si el rol es válido
    private function rolValido($fk_roles) {
        $query = "SELECT 1 FROM roles WHERE pk_roles = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $fk_roles);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Función para verificar si el área es válida
    private function areaValida($fk_area) {
        $query = "SELECT 1 FROM area WHERE pk_area = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $fk_area);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }



    public function validarLogin($correo, $contrasena) {
        $query = "SELECT * FROM persona WHERE correo = '$correo' AND contrasena = '$contrasena'";
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc(); 
        }
        return false; 
    }
}

class Tanque {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();  // Crea una instancia de la clase Conexion
        $this->conn = $conexion->conn;  // Obtiene la conexión
    }

    public function registrar_tanque($capacidad, $temperatura, $iluminacion, $filtracion, $fk_area, $fk_especie, $fecha) {
        if (empty($capacidad) || empty($temperatura) || empty($iluminacion) || empty($filtracion) || empty($fk_area) || empty($fk_especie) || empty($fecha)) {
            return false; 
        }
    
        // Crear la consulta SQL (asegúrate de que los nombres sean correctos)
        $sql = "INSERT INTO tanque (capacidad, temperatura, iluminacion, filtracion, fk_area, fk_especie, fecha) 
                VALUES ('$capacidad', '$temperatura', '$iluminacion', '$filtracion', '$fk_area', '$fk_especie', '$fecha')";
    
        // Ejecutar la consulta
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return "Error en la consulta: " . $this->conn->error;
        }
    }

   
}

?>
