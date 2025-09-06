<?php
require_once 'models/Destination.php';
require_once 'models/Schedule.php';
require_once 'models/Bus.php';
require_once 'models/Reservation.php';

class ReservationController {
    private $destinationModel;
    private $scheduleModel;
    private $busModel;
    private $reservationModel;
    
    public function __construct() {
        $this->destinationModel = new Destination();
        $this->scheduleModel = new Schedule();
        $this->busModel = new Bus();
        $this->reservationModel = new Reservation();
    }
    
    public function search() {
        $origins = $this->destinationModel->getOrigins();
        $destinations = [];
        $schedules = [];
        $message = '';
        
        if ($_POST) {
            $origin = $_POST['origin'] ?? '';
            $destination = $_POST['destination'] ?? '';
            $date = $_POST['date'] ?? '';
            
            if ($origin && $destination) {
                $schedules = $this->scheduleModel->searchSchedules($origin, $destination, $date);
                if (empty($schedules)) {
                    $message = 'No se encontraron viajes para la búsqueda realizada.';
                }
            }
        }
        
        // AJAX para obtener destinos por origen
        if (isset($_GET['ajax']) && $_GET['ajax'] == 'destinations' && isset($_GET['origin'])) {
            $destinations = $this->destinationModel->getDestinationsByOrigin($_GET['origin']);
            header('Content-Type: application/json');
            echo json_encode($destinations);
            exit();
        }
        
        include 'views/reservation/search.php';
    }
    
    public function selectSchedule() {
        if (!isset($_GET['schedule_id'])) {
            header('Location: index.php?controller=reservation&action=search');
            exit();
        }
        
        $scheduleId = $_GET['schedule_id'];
        $schedule = $this->scheduleModel->getById($scheduleId);
        
        if (!$schedule) {
            header('Location: index.php?controller=reservation&action=search');
            exit();
        }
        
        include 'views/reservation/schedule_details.php';
    }
    
    public function selectSeat() {
        if (!isset($_GET['schedule_id'])) {
            header('Location: index.php?controller=reservation&action=search');
            exit();
        }
        
        $scheduleId = $_GET['schedule_id'];
        $schedule = $this->scheduleModel->getById($scheduleId);
        
        if (!$schedule) {
            header('Location: index.php?controller=reservation&action=search');
            exit();
        }
        
        // Obtener disposición de asientos
        $busLayout = $this->busModel->getSeatLayout($schedule['bus_id']);
        $occupiedSeats = $this->scheduleModel->getOccupiedSeats($scheduleId);
        
        include 'views/reservation/select_seat.php';
    }
    
    public function confirm() {
        $message = '';
        $success = false;
        
        if ($_POST) {
            $scheduleId = $_POST['schedule_id'] ?? '';
            $seatNumber = $_POST['seat_number'] ?? '';
            $customerName = $_POST['customer_name'] ?? '';
            $customerEmail = $_POST['customer_email'] ?? '';
            
            // Validaciones
            if (empty($customerName) || empty($customerEmail) || empty($seatNumber)) {
                $message = 'Todos los campos son obligatorios.';
            } elseif (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
                $message = 'El email no es válido.';
            } else {
                // Verificar que el asiento esté disponible
                if (!$this->reservationModel->isSeatAvailable($scheduleId, $seatNumber)) {
                    $message = 'El asiento seleccionado ya no está disponible.';
                } else {
                    // Crear la reserva
                    $result = $this->reservationModel->create($scheduleId, $customerName, $customerEmail, $seatNumber);
                    
                    if ($result['success']) {
                        $success = true;
                        $reservationId = $result['reservation_id'];
                        $reservation = $this->reservationModel->getById($reservationId);
                        $message = 'Reserva confirmada exitosamente. ID de reserva: ' . $reservationId;
                    } else {
                        $message = $result['message'];
                    }
                }
            }
        } else {
            // Mostrar formulario de confirmación
            $scheduleId = $_GET['schedule_id'] ?? '';
            $seatNumber = $_GET['seat_number'] ?? '';
            
            if (!$scheduleId || !$seatNumber) {
                header('Location: index.php?controller=reservation&action=search');
                exit();
            }
            
            $schedule = $this->scheduleModel->getById($scheduleId);
            if (!$schedule) {
                header('Location: index.php?controller=reservation&action=search');
                exit();
            }
        }
        
        include 'views/reservation/confirm.php';
    }
}
?> 