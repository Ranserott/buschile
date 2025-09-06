<?php
require_once 'models/Destination.php';

class HomeController {
    private $destinationModel;
    
    public function __construct() {
        $this->destinationModel = new Destination();
    }
    
    public function index() {
        $origins = $this->destinationModel->getOrigins();
        include 'views/home.php';
    }
}
?> 