<?php
include_once 'clase_conexion.php'; // Cambiar a include_once para evitar múltiples inclusiones

class OpcionesFormulario {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
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

    public function eliminarEmpleado($id) {
        $sql = "UPDATE persona SET estatus = 0 WHERE pk_persona = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_Param('i', $id);
        return $stmt->execute();
    }
    
    public function obtenerEmpleadoPorId($id) {
        $sql = "SELECT * FROM persona WHERE pk_persona = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_Param('i', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    
    public function actualizarEmpleado($datos) {
        $sql = "UPDATE persona 
                SET nombre = :nombre, apaterno = :apaterno, amaterno = :amaterno, fecha_nac = :fecha_nac,
                    direccion = :direccion, correo = :correo, telefono = :telefono, genero = :genero,
                    fk_roles = :fk_roles, fk_area = :fk_area
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($datos);
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
    public function obtenerOpcionesInventario() {
        $sql = "SELECT pk_inventario, nombre FROM inventario where fk_categoria = 1";
        $result = $this->conn->query($sql);
        $opciones = "";

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $opciones .= "<option value='" . $row['pk_inventario'] . "'>" . $row['nombre'] . "</option>";
            }
        } else {
            $opciones = "<option value=''>No se encontron alimentos</option>";
        }

        return $opciones;
    }
    
    public function obtenerOpcionesTanques() {
        $sql = "SELECT pk_tanque FROM tanque";
        $result = $this->conn->query($sql);
        $opciones = "";
    
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $opciones .= "<option value='" . $row['pk_tanque'] . "'>" . $row['pk_tanque'] . "</option>";
            }
        } else {
            $opciones = "<option value=''>No se encontraron tanques</option>";
        }
    
        return $opciones;
    }

    public function obtenerEquipoPorId($id) {
        
        $sql = "SELECT * FROM equipo WHERE pk_equipo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
    
    public function actualizar($id, $nombre, $estado, $fk_tanque, $fecha) {
        
        $sql = "UPDATE equipo SET nombre = ?, estado = ?, fk_tanque = ?, fecha = ? WHERE pk_equipo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $nombre, $estado, $fk_tanque, $fecha, $id);
        return $stmt->execute();
    }
    
    public function eliminar($id) {
        
        $sql = "UPDATE equipo SET estatus = 0 WHERE pk_equipo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
}

class ValidarUsuario {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
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
        $this->conn = Conexion::conectar();
    }

    public function registrar_tanque($capacidad, $temperatura, $iluminacion, $filtracion, $fk_area, $fk_especie, $fecha) {
        if (empty($capacidad) || empty($temperatura) || empty($iluminacion) || empty($filtracion) || empty($fk_area) || empty($fk_especie) || empty($fecha)) {
            return false; 
        }
    
        // Crear la consulta SQL (asegúrate de que los nombres sean correctos)
        $sql = "INSERT INTO tanque (capacidad, temperatura, iluminacion, filtracion, fk_area, fk_especie, fecha, estatus) 
                VALUES ('$capacidad', '$temperatura', '$iluminacion', '$filtracion', '$fk_area', '$fk_especie', '$fecha', 1)";
    
        // Ejecutar la consulta
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return "Error en la consulta: " . $this->conn->error;
        }
    }

   
}

class Inventario {

    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
    }

    public function registrar_alimentacion($cantidad, $descripcion, $hora, $fecha, $fk_area, $fk_especie, $fk_inventario) {
        // Consulta SQL para insertar los datos
        $sql = "INSERT INTO alimentacion (cantidad, descripcion, hora, fecha, fk_area, fk_especie, fk_inventario) 
                VALUES ('$cantidad', '$descripcion', '$hora', '$fecha', '$fk_area', '$fk_especie', '$fk_inventario')";
        
        // Ejecutar la consulta y devolver el resultado
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return "Error en la consulta: " . $this->conn->error;
        }
    }
    
}

class CalidadAgua {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
    }

    public function registrarCalidadAgua($ph, $amoniaco, $nitrato, $nitritos, $fk_tanque, $fecha) {
        $sql = "INSERT INTO agua (ph, amoniaco, nitrato, nitritos, fk_tanque, fecha) 
                VALUES ('$ph', '$amoniaco', '$nitrato', '$nitritos', '$fk_tanque', '$fecha')";

if ($this->conn->query($sql)) {
    return true;
} else {
    return "Error en la consulta: " . $this->conn->error;
}
}
}

class Nose {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
    }

    public function obtenerEquipoPorId($equipo_id){
        $sql = "SELECT * FROM tanque WHERE pk_tanque = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $equipo_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

}
?>
