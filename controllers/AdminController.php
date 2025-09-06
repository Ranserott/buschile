<?php
require_once 'models/Admin.php';
require_once 'models/Destination.php';
require_once 'models/Bus.php';
require_once 'models/Schedule.php';
require_once 'models/Reservation.php';

class AdminController {
    private $adminModel;
    private $destinationModel;
    private $busModel;
    private $scheduleModel;
    private $reservationModel;
    
    public function __construct() {
        $this->adminModel = new Admin();
        $this->destinationModel = new Destination();
        $this->busModel = new Bus();
        $this->scheduleModel = new Schedule();
        $this->reservationModel = new Reservation();
    }
    
    public function login() {
        $error = '';
        
        if ($_POST) {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if ($admin = $this->adminModel->login($username, $password)) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                header('Location: index.php?controller=admin&action=dashboard');
                exit();
            } else {
                $error = 'Credenciales incorrectas';
            }
        }
        
        include 'views/admin/login.php';
    }
    
    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit();
    }
    
    public function dashboard() {
        $this->adminModel->requireLogin();
        
        // Estadísticas básicas
        $totalReservations = count($this->reservationModel->getAll());
        $totalDestinations = count($this->destinationModel->getAll());
        $totalBuses = count($this->busModel->getAll());
        $totalSchedules = count($this->scheduleModel->getAll());
        
        include 'views/admin/dashboard.php';
    }
    
    public function destinations() {
        $this->adminModel->requireLogin();
        
        $message = '';
        $destinations = $this->destinationModel->getAll();
        
        // Manejar acciones CRUD
        if ($_POST) {
            $action = $_POST['action'] ?? '';
            
            switch ($action) {
                case 'create':
                    if ($this->destinationModel->create($_POST['origin'], $_POST['destination'], $_POST['duration_hours'], $_POST['price'])) {
                        $message = 'Destino creado exitosamente';
                        $destinations = $this->destinationModel->getAll();
                    } else {
                        $message = 'Error al crear destino';
                    }
                    break;
                    
                case 'update':
                    if ($this->destinationModel->update($_POST['id'], $_POST['origin'], $_POST['destination'], $_POST['duration_hours'], $_POST['price'])) {
                        $message = 'Destino actualizado exitosamente';
                        $destinations = $this->destinationModel->getAll();
                    } else {
                        $message = 'Error al actualizar destino';
                    }
                    break;
                    
                case 'delete':
                    if ($this->destinationModel->delete($_POST['id'])) {
                        $message = 'Destino eliminado exitosamente';
                        $destinations = $this->destinationModel->getAll();
                    } else {
                        $message = 'Error al eliminar destino';
                    }
                    break;
            }
        }
        
        include 'views/admin/destinations.php';
    }
    
    public function buses() {
        $this->adminModel->requireLogin();
        
        $message = '';
        $buses = $this->busModel->getAll();
        
        // Manejar acciones CRUD
        if ($_POST) {
            $action = $_POST['action'] ?? '';
            
            switch ($action) {
                case 'create':
                    if ($this->busModel->create($_POST['name'], $_POST['seat_rows'], $_POST['seat_columns'])) {
                        $message = 'Bus creado exitosamente';
                        $buses = $this->busModel->getAll();
                    } else {
                        $message = 'Error al crear bus';
                    }
                    break;
                    
                case 'update':
                    if ($this->busModel->update($_POST['id'], $_POST['name'], $_POST['seat_rows'], $_POST['seat_columns'])) {
                        $message = 'Bus actualizado exitosamente';
                        $buses = $this->busModel->getAll();
                    } else {
                        $message = 'Error al actualizar bus';
                    }
                    break;
                    
                case 'delete':
                    if ($this->busModel->delete($_POST['id'])) {
                        $message = 'Bus eliminado exitosamente';
                        $buses = $this->busModel->getAll();
                    } else {
                        $message = 'Error al eliminar bus';
                    }
                    break;
            }
        }
        
        include 'views/admin/buses.php';
    }
    
    public function schedules() {
        $this->adminModel->requireLogin();
        
        $message = '';
        $schedules = $this->scheduleModel->getAll();
        $destinations = $this->destinationModel->getAll();
        $buses = $this->busModel->getAll();
        
        // Manejar acciones CRUD
        if ($_POST) {
            $action = $_POST['action'] ?? '';
            
            switch ($action) {
                case 'create':
                    if ($this->scheduleModel->create($_POST['destination_id'], $_POST['bus_id'], $_POST['departure_date'], $_POST['departure_time'], $_POST['arrival_time'])) {
                        $message = 'Horario creado exitosamente';
                        $schedules = $this->scheduleModel->getAll();
                    } else {
                        $message = 'Error al crear horario';
                    }
                    break;
                    
                case 'update':
                    if ($this->scheduleModel->update($_POST['id'], $_POST['destination_id'], $_POST['bus_id'], $_POST['departure_date'], $_POST['departure_time'], $_POST['arrival_time'])) {
                        $message = 'Horario actualizado exitosamente';
                        $schedules = $this->scheduleModel->getAll();
                    } else {
                        $message = 'Error al actualizar horario';
                    }
                    break;
                    
                case 'delete':
                    if ($this->scheduleModel->delete($_POST['id'])) {
                        $message = 'Horario eliminado exitosamente';
                        $schedules = $this->scheduleModel->getAll();
                    } else {
                        $message = 'Error al eliminar horario';
                    }
                    break;
            }
        }
        
        include 'views/admin/schedules.php';
    }
    
    public function reservations() {
        $this->adminModel->requireLogin();
        
        $message = '';
        $reservations = $this->reservationModel->getAll();
        
        // Manejar cancelación de reservas
        if ($_POST && $_POST['action'] == 'cancel') {
            if ($this->reservationModel->cancel($_POST['id'])) {
                $message = 'Reserva cancelada exitosamente';
                $reservations = $this->reservationModel->getAll();
            } else {
                $message = 'Error al cancelar reserva';
            }
        }
        
        include 'views/admin/reservations.php';
    }
}
?> 