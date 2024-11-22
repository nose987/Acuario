<?php 
require_once("conexion.php");

class Login{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function validarUsuario($correo, $contrasena) {
        try {
            // Consulta para verificar las credenciales del usuario
            $query = "SELECT p.pk_persona, p.nombre, p.correo, p.contrasena, p.fk_roles, r.roles 
                     FROM persona p 
                     INNER JOIN roles r ON p.fk_roles = r.pk_roles 
                     WHERE p.correo = ? AND r.estatus = 1";
            
            $stmt = $this->conexion->prepare($query);
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            
            // Obtener resultados
            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();

            // Verificar si existe el usuario y la contraseña es correcta
            if ($usuario && $contrasena === $usuario['contrasena']) {
                // Iniciar sesión
                session_start();
                
                // Guardar datos en la sesión
                $_SESSION['usuario_id'] = $usuario['pk_persona'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['correo'] = $usuario['correo'];
                $_SESSION['rol_id'] = $usuario['fk_roles'];
                $_SESSION['rol_nombre'] = $usuario['roles'];
                
                // Redirigir según el rol
                if($_SESSION['rol_id']) {
                   header('Location: panel.php');
                }else{
                    header('Location: login.php');
                }
                exit();
            }
            return false;
        } catch (Exception $e) {
            error_log("Error en validarUsuario: " . $e->getMessage());
            return false;
        }
    }

    public function cerrarSesion() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../views/login.php');
        exit();
    }


    public function validarRol() {
        // Verificar si existe una sesión activa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Verificar si el usuario está logueado
        if (!isset($_SESSION['rol_id']) || !isset($_SESSION['usuario_id'])) {
            header('Location: login.php');
            exit();
        }
    
        $rol_id = $_SESSION['rol_id'];
        $script_actual = basename($_SERVER['SCRIPT_NAME']);
    
        // Definir las páginas permitidas para cada rol
        $paginas_veterinario = [
            'lista_diagnostico_especies.php', 
            'lista_especies.php', 
            'lista_salud_especies.php',
            'lista_tratamiento_especies.php', 
            'registro_detalle_tratamiento.php', 
            'registro_diagnostico_especies.php',
            'registro_salud_especies.php', 
            'registro_tratamiento_especies.php', 
            'tabla_alimentacion.php', 
            'tabla_agua.php'
        ];
    
        $paginas_cuidador = [
            'alimentacion.php', 
            'lista_diagnostico_especies.php', 
            'lista_especies.php', 
            'lista_salud_especies.php',
            'lista_tratamiento_especies.php', 
            'tabla_agua.php', 
            'tabla_alimentacion.php', 
            'tabla_tanques.php'
        ];
    
        $paginas_acuatico = [
            'formulario_agua.php', 
            'tabla_agua.php', 
            'tabla_tanques.php', 
            'lista_diagnostico_especies.php',
            'lista_especies.php', 
            'tabla_equipo.php'
        ];
    
        $paginas_mantenimiento = [
            'tabla_mantenimiento.php', 
            'tabla_equipo.php', 
            'formulario_mantenimiento.php'
        ];
    
        // Si es administrador (rol_id = 3), permitir acceso a todo
        if ($rol_id == 3) {
            return true;
        }
    
        // Validar acceso según el rol
        switch ($rol_id) {
            case 1: // Veterinario
                return in_array($script_actual, $paginas_veterinario);
            case 2: // Cuidador
                return in_array($script_actual, $paginas_cuidador);
            case 4: // Acuático
                return in_array($script_actual, $paginas_acuatico);
            case 5: // Mantenimiento
                return in_array($script_actual, $paginas_mantenimiento);
            default:
                return false;
        }
    }

    public function protegerPagina() {
        if (!$this->validarRol()) {
            header('Location: panel.php');
            exit();
        }}

}




?>