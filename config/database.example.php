<?php
/**
 * Configuración de Base de Datos - Archivo de Ejemplo
 * 
 * Copia este archivo como 'database.php' y actualiza las credenciales
 * con los datos de tu servidor de base de datos.
 */

class Database {
    // Configuración de la base de datos
    private $host = 'localhost';              // Servidor de base de datos
    private $db_name = 'bus_reservation';     // Nombre de la base de datos
    private $username = 'tu_usuario';         // Usuario de la base de datos
    private $password = 'tu_contraseña';      // Contraseña de la base de datos
    private $conn;

    /**
     * Obtiene la conexión a la base de datos
     * @return PDO|null Conexión PDO o null en caso de error
     */
    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch(PDOException $exception) {
            error_log("Error de conexión a la base de datos: " . $exception->getMessage());
            die("Error de conexión a la base de datos. Por favor, verifica la configuración.");
        }
        
        return $this->conn;
    }
}

/**
 * Función global para obtener conexión a la base de datos
 * @return PDO Conexión PDO
 */
function getDB() {
    $database = new Database();
    return $database->getConnection();
}
?>