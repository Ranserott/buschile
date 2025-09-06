<?php
/**
 * Script de Instalación Automática - BusChile
 * 
 * Este script ayuda a configurar automáticamente la base de datos
 * y verificar los requisitos del sistema.
 * 
 * Uso: Accede a este archivo desde tu navegador después de configurar
 * las credenciales de base de datos en config/database.php
 */

// Verificar si ya está instalado
if (file_exists('INSTALLED')) {
    die('⚠️ El sistema ya está instalado. Si necesitas reinstalar, elimina el archivo INSTALLED.');
}

$errors = [];
$success = [];
$warnings = [];

// Verificar requisitos del sistema
function checkRequirements() {
    global $errors, $warnings;
    
    // Verificar versión de PHP
    if (version_compare(PHP_VERSION, '7.4.0', '<')) {
        $errors[] = 'Se requiere PHP 7.4 o superior. Versión actual: ' . PHP_VERSION;
    } else {
        $success[] = 'Versión de PHP: ' . PHP_VERSION . ' ✅';
    }
    
    // Verificar extensiones requeridas
    $required_extensions = ['pdo', 'pdo_mysql', 'mbstring', 'json'];
    foreach ($required_extensions as $ext) {
        if (!extension_loaded($ext)) {
            $errors[] = "Extensión PHP requerida no encontrada: {$ext}";
        }
    }
    
    // Verificar permisos de escritura
    if (!is_writable('.')) {
        $warnings[] = 'El directorio raíz no tiene permisos de escritura. Esto podría causar problemas.';
    }
    
    // Verificar archivo de configuración
    if (!file_exists('config/database.php')) {
        $errors[] = 'Archivo config/database.php no encontrado. Copia database.example.php como database.php';
    }
}

// Verificar conexión a base de datos
function checkDatabase() {
    global $errors, $success;
    
    try {
        require_once 'config/database.php';
        $db = new Database();
        $conn = $db->getConnection();
        
        if ($conn) {
            $success[] = 'Conexión a base de datos exitosa ✅';
            return $conn;
        }
    } catch (Exception $e) {
        $errors[] = 'Error de conexión a base de datos: ' . $e->getMessage();
    }
    
    return false;
}

// Instalar esquema de base de datos
function installDatabase($conn) {
    global $errors, $success;
    
    try {
        $sql = file_get_contents('database/schema.sql');
        
        // Dividir el SQL en statements individuales
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        
        foreach ($statements as $statement) {
            if (!empty($statement)) {
                $conn->exec($statement);
            }
        }
        
        $success[] = 'Base de datos instalada correctamente ✅';
        return true;
    } catch (Exception $e) {
        $errors[] = 'Error al instalar base de datos: ' . $e->getMessage();
        return false;
    }
}

// Crear archivo de instalación completada
function markAsInstalled() {
    $content = "BusChile instalado el: " . date('Y-m-d H:i:s') . "\n";
    $content .= "Versión PHP: " . PHP_VERSION . "\n";
    $content .= "Usuario: " . (isset($_SERVER['USER']) ? $_SERVER['USER'] : 'Desconocido') . "\n";
    
    file_put_contents('INSTALLED', $content);
}

// Procesar instalación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['install'])) {
    checkRequirements();
    
    if (empty($errors)) {
        $conn = checkDatabase();
        
        if ($conn && empty($errors)) {
            if (installDatabase($conn)) {
                markAsInstalled();
                $success[] = '🎉 ¡Instalación completada exitosamente!';
                $success[] = 'Puedes acceder al sistema en: <a href="index.php">Página Principal</a>';
                $success[] = 'Panel de administración: <a href="index.php?controller=admin">Admin Panel</a>';
                $success[] = 'Credenciales por defecto - Usuario: admin, Contraseña: password';
            }
        }
    }
} else {
    checkRequirements();
    checkDatabase();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalación - BusChile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .install-container { max-width: 800px; margin: 50px auto; }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .card-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 15px 15px 0 0 !important; }
        .alert { border-radius: 10px; }
        .btn-install { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; }
    </style>
</head>
<body>
    <div class="container install-container">
        <div class="card">
            <div class="card-header text-center py-4">
                <h1 class="mb-0">
                    <i class="fas fa-bus me-3"></i>
                    Instalación BusChile
                </h1>
                <p class="mb-0 mt-2">Sistema de Reservas de Autobuses</p>
            </div>
            <div class="card-body p-5">
                
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <h5><i class="fas fa-exclamation-triangle me-2"></i>Errores Encontrados</h5>
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($warnings)): ?>
                    <div class="alert alert-warning">
                        <h5><i class="fas fa-exclamation-circle me-2"></i>Advertencias</h5>
                        <ul class="mb-0">
                            <?php foreach ($warnings as $warning): ?>
                                <li><?= htmlspecialchars($warning) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success">
                        <h5><i class="fas fa-check-circle me-2"></i>Estado del Sistema</h5>
                        <ul class="mb-0">
                            <?php foreach ($success as $msg): ?>
                                <li><?= $msg ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <?php if (empty($errors) && !file_exists('INSTALLED')): ?>
                    <div class="text-center">
                        <h4 class="mb-4">¿Listo para instalar?</h4>
                        <p class="text-muted mb-4">
                            Este proceso creará las tablas necesarias en tu base de datos
                            e insertará los datos de ejemplo.
                        </p>
                        
                        <form method="POST">
                            <button type="submit" name="install" class="btn btn-install btn-lg px-5">
                                <i class="fas fa-download me-2"></i>
                                Instalar BusChile
                            </button>
                        </form>
                    </div>
                <?php elseif (file_exists('INSTALLED')): ?>
                    <div class="alert alert-info text-center">
                        <h4><i class="fas fa-info-circle me-2"></i>Sistema Ya Instalado</h4>
                        <p class="mb-3">BusChile ya está instalado y listo para usar.</p>
                        <a href="index.php" class="btn btn-primary me-2">
                            <i class="fas fa-home me-1"></i>Ir al Sistema
                        </a>
                        <a href="index.php?controller=admin" class="btn btn-outline-primary">
                            <i class="fas fa-cog me-1"></i>Panel Admin
                        </a>
                    </div>
                <?php endif; ?>
                
                <hr class="my-4">
                
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <i class="fas fa-database fa-2x text-primary mb-2"></i>
                            <h6>Base de Datos</h6>
                            <small class="text-muted">MySQL 5.7+</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <i class="fab fa-php fa-2x text-primary mb-2"></i>
                            <h6>PHP</h6>
                            <small class="text-muted">Versión 7.4+</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <i class="fas fa-server fa-2x text-primary mb-2"></i>
                            <h6>Servidor Web</h6>
                            <small class="text-muted">Apache/Nginx</small>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Si tienes problemas, revisa la documentación en el archivo README.md
                    </small>
                </div>
                
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>