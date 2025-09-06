<?php
require_once 'config/database.php';

class Admin {
    private $conn;
    
    public function __construct() {
        $this->conn = getDB();
    }
    
    public function login($username, $password) {
        $query = "SELECT id, username, password, email FROM admins WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $admin['password'])) {
                return $admin;
            }
        }
        return false;
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['admin_id']);
    }
    
    public function requireLogin() {
        if (!$this->isLoggedIn()) {
            header('Location: index.php?controller=admin&action=login');
            exit();
        }
    }
}
?> 