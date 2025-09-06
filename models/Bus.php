<?php
require_once 'config/database.php';

class Bus {
    private $conn;
    
    public function __construct() {
        $this->conn = getDB();
    }
    
    public function getAll() {
        $query = "SELECT * FROM buses ORDER BY name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $query = "SELECT * FROM buses WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($name, $seat_rows, $seat_columns) {
        $query = "INSERT INTO buses (name, seat_rows, seat_columns) VALUES (:name, :seat_rows, :seat_columns)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':seat_rows', $seat_rows);
        $stmt->bindParam(':seat_columns', $seat_columns);
        return $stmt->execute();
    }
    
    public function update($id, $name, $seat_rows, $seat_columns) {
        $query = "UPDATE buses SET name = :name, seat_rows = :seat_rows, seat_columns = :seat_columns WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':seat_rows', $seat_rows);
        $stmt->bindParam(':seat_columns', $seat_columns);
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM buses WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function getSeatLayout($busId) {
        $bus = $this->getById($busId);
        if (!$bus) return null;
        
        $layout = [];
        $seatNumber = 1;
        
        for ($row = 1; $row <= $bus['seat_rows']; $row++) {
            $layout[$row] = [];
            for ($col = 1; $col <= $bus['seat_columns']; $col++) {
                $layout[$row][$col] = $seatNumber++;
            }
        }
        
        return [
            'bus' => $bus,
            'layout' => $layout
        ];
    }
}
?> 