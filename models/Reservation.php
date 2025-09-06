<?php
require_once 'config/database.php';

class Reservation {
    private $conn;
    
    public function __construct() {
        $this->conn = getDB();
    }
    
    public function getAll() {
        $query = "SELECT r.*, s.departure_date, s.departure_time, 
                         d.origin, d.destination, d.price, b.name as bus_name
                  FROM reservations r 
                  JOIN schedules s ON r.schedule_id = s.id 
                  JOIN destinations d ON s.destination_id = d.id 
                  JOIN buses b ON s.bus_id = b.id 
                  ORDER BY s.departure_date DESC, s.departure_time DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $query = "SELECT r.*, s.departure_date, s.departure_time, 
                         d.origin, d.destination, d.price, b.name as bus_name
                  FROM reservations r 
                  JOIN schedules s ON r.schedule_id = s.id 
                  JOIN destinations d ON s.destination_id = d.id 
                  JOIN buses b ON s.bus_id = b.id 
                  WHERE r.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($schedule_id, $customer_name, $customer_email, $seat_number) {
        try {
            $this->conn->beginTransaction();
            
            // Verificar que el asiento no esté ocupado
            $checkQuery = "SELECT id FROM reservations WHERE schedule_id = :schedule_id 
                          AND seat_number = :seat_number AND status = 'confirmed'";
            $checkStmt = $this->conn->prepare($checkQuery);
            $checkStmt->bindParam(':schedule_id', $schedule_id);
            $checkStmt->bindParam(':seat_number', $seat_number);
            $checkStmt->execute();
            
            if ($checkStmt->rowCount() > 0) {
                $this->conn->rollBack();
                return ['success' => false, 'message' => 'El asiento ya está ocupado'];
            }
            
            // Crear la reserva
            $query = "INSERT INTO reservations (schedule_id, customer_name, customer_email, seat_number) 
                      VALUES (:schedule_id, :customer_name, :customer_email, :seat_number)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':schedule_id', $schedule_id);
            $stmt->bindParam(':customer_name', $customer_name);
            $stmt->bindParam(':customer_email', $customer_email);
            $stmt->bindParam(':seat_number', $seat_number);
            
            if ($stmt->execute()) {
                $reservationId = $this->conn->lastInsertId();
                $this->conn->commit();
                return ['success' => true, 'reservation_id' => $reservationId];
            } else {
                $this->conn->rollBack();
                return ['success' => false, 'message' => 'Error al crear la reserva'];
            }
            
        } catch (Exception $e) {
            $this->conn->rollBack();
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
    
    public function cancel($id) {
        $query = "UPDATE reservations SET status = 'cancelled' WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM reservations WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function isSeatAvailable($schedule_id, $seat_number) {
        $query = "SELECT id FROM reservations WHERE schedule_id = :schedule_id 
                  AND seat_number = :seat_number AND status = 'confirmed'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':schedule_id', $schedule_id);
        $stmt->bindParam(':seat_number', $seat_number);
        $stmt->execute();
        return $stmt->rowCount() == 0;
    }
}
?> 