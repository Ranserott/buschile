<?php
require_once 'config/database.php';

class Schedule {
    private $conn;
    
    public function __construct() {
        $this->conn = getDB();
    }
    
    public function getAll() {
        $query = "SELECT s.*, d.origin, d.destination, d.price, b.name as bus_name 
                  FROM schedules s 
                  JOIN destinations d ON s.destination_id = d.id 
                  JOIN buses b ON s.bus_id = b.id 
                  ORDER BY s.departure_date, s.departure_time";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $query = "SELECT s.*, d.origin, d.destination, d.price, d.duration_hours, 
                         b.name as bus_name, b.seat_rows, b.seat_columns, b.total_seats
                  FROM schedules s 
                  JOIN destinations d ON s.destination_id = d.id 
                  JOIN buses b ON s.bus_id = b.id 
                  WHERE s.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($destination_id, $bus_id, $departure_date, $departure_time, $arrival_time) {
        $query = "INSERT INTO schedules (destination_id, bus_id, departure_date, departure_time, arrival_time) 
                  VALUES (:destination_id, :bus_id, :departure_date, :departure_time, :arrival_time)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':destination_id', $destination_id);
        $stmt->bindParam(':bus_id', $bus_id);
        $stmt->bindParam(':departure_date', $departure_date);
        $stmt->bindParam(':departure_time', $departure_time);
        $stmt->bindParam(':arrival_time', $arrival_time);
        return $stmt->execute();
    }
    
    public function update($id, $destination_id, $bus_id, $departure_date, $departure_time, $arrival_time) {
        $query = "UPDATE schedules SET destination_id = :destination_id, bus_id = :bus_id, 
                  departure_date = :departure_date, departure_time = :departure_time, 
                  arrival_time = :arrival_time WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':destination_id', $destination_id);
        $stmt->bindParam(':bus_id', $bus_id);
        $stmt->bindParam(':departure_date', $departure_date);
        $stmt->bindParam(':departure_time', $departure_time);
        $stmt->bindParam(':arrival_time', $arrival_time);
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM schedules WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function searchSchedules($origin, $destination, $date = null) {
        $query = "SELECT s.*, d.origin, d.destination, d.price, d.duration_hours, 
                         b.name as bus_name, b.total_seats,
                         (SELECT COUNT(*) FROM reservations r WHERE r.schedule_id = s.id AND r.status = 'confirmed') as occupied_seats
                  FROM schedules s 
                  JOIN destinations d ON s.destination_id = d.id 
                  JOIN buses b ON s.bus_id = b.id 
                  WHERE d.origin = :origin AND d.destination = :destination 
                  AND s.status = 'active'";
        
        if ($date) {
            $query .= " AND s.departure_date = :date";
        } else {
            $query .= " AND s.departure_date >= CURDATE()";
        }
        
        $query .= " ORDER BY s.departure_date, s.departure_time";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':origin', $origin);
        $stmt->bindParam(':destination', $destination);
        if ($date) {
            $stmt->bindParam(':date', $date);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getOccupiedSeats($scheduleId) {
        $query = "SELECT seat_number FROM reservations WHERE schedule_id = :schedule_id AND status = 'confirmed'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':schedule_id', $scheduleId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?> 