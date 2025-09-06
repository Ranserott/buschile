<?php
session_start();
require_once 'config/database.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/ReservationController.php';

// Obtener la acción de la URL
$action = $_GET['action'] ?? 'home';
$controller = $_GET['controller'] ?? 'home';

// Enrutamiento simple
switch ($controller) {
    case 'admin':
        $adminController = new AdminController();
        switch ($action) {
            case 'login':
                $adminController->login();
                break;
            case 'logout':
                $adminController->logout();
                break;
            case 'dashboard':
                $adminController->dashboard();
                break;
            case 'destinations':
                $adminController->destinations();
                break;
            case 'schedules':
                $adminController->schedules();
                break;
            case 'buses':
                $adminController->buses();
                break;
            case 'reservations':
                $adminController->reservations();
                break;
            default:
                $adminController->login();
                break;
        }
        break;
    
    case 'reservation':
        $reservationController = new ReservationController();
        switch ($action) {
            case 'search':
                $reservationController->search();
                break;
            case 'select_schedule':
                $reservationController->selectSchedule();
                break;
            case 'select_seat':
                $reservationController->selectSeat();
                break;
            case 'confirm':
                $reservationController->confirm();
                break;
            default:
                $reservationController->search();
                break;
        }
        break;
    
    default:
        $homeController = new HomeController();
        $homeController->index();
        break;
}
?> 