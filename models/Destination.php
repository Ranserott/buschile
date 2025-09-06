<?php
require_once 'config/database.php';

class Destination {
    private $conn;
    
    public function __construct() {
        $this->conn = getDB();
    }
    
    public function getAll() {
        $query = "SELECT * FROM destinations ORDER BY origin, destination";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $query = "SELECT * FROM destinations WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($origin, $destination, $duration_hours, $price) {
        $query = "INSERT INTO destinations (origin, destination, duration_hours, price) 
                  VALUES (:origin, :destination, :duration_hours, :price)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':origin', $origin);
        $stmt->bindParam(':destination', $destination);
        $stmt->bindParam(':duration_hours', $duration_hours);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }
    
    public function update($id, $origin, $destination, $duration_hours, $price) {
        $query = "UPDATE destinations SET origin = :origin, destination = :destination, 
                  duration_hours = :duration_hours, price = :price WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':origin', $origin);
        $stmt->bindParam(':destination', $destination);
        $stmt->bindParam(':duration_hours', $duration_hours);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM destinations WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function getOrigins() {
        $query = "SELECT DISTINCT origin FROM destinations ORDER BY origin";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public function getDestinationsByOrigin($origin) {
        $query = "SELECT DISTINCT destination FROM destinations WHERE origin = :origin ORDER BY destination";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':origin', $origin);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?> 