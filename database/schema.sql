-- Crear base de datos
CREATE DATABASE IF NOT EXISTS bus_reservation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bus_reservation;

-- Tabla de administradores
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de destinos
CREATE TABLE IF NOT EXISTS destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    origin VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    duration_hours INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de buses
CREATE TABLE IF NOT EXISTS buses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    seat_rows INT NOT NULL,
    seat_columns INT NOT NULL,
    total_seats INT GENERATED ALWAYS AS (seat_rows * seat_columns) STORED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de horarios
CREATE TABLE IF NOT EXISTS schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    destination_id INT NOT NULL,
    bus_id INT NOT NULL,
    departure_date DATE NOT NULL,
    departure_time TIME NOT NULL,
    arrival_time TIME NOT NULL,
    status ENUM('active', 'cancelled') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (destination_id) REFERENCES destinations(id) ON DELETE CASCADE,
    FOREIGN KEY (bus_id) REFERENCES buses(id) ON DELETE CASCADE
);

-- Tabla de reservas
CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    schedule_id INT NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    seat_number INT NOT NULL,
    status ENUM('confirmed', 'cancelled') DEFAULT 'confirmed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (schedule_id) REFERENCES schedules(id) ON DELETE CASCADE,
    UNIQUE KEY unique_seat_schedule (schedule_id, seat_number)
);

-- Insertar administrador por defecto
INSERT INTO admins (username, password, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@buses.com');
-- Contraseña: password

-- Insertar algunos destinos de ejemplo con precios en pesos chilenos
INSERT INTO destinations (origin, destination, duration_hours, price) VALUES 
('Santiago', 'Valparaíso', 2, 3500.00),
('Santiago', 'Concepción', 6, 12500.00),
('Santiago', 'La Serena', 5, 9800.00),
('Valparaíso', 'Viña del Mar', 1, 1500.00),
('Santiago', 'Temuco', 8, 15200.00),
('Concepción', 'Puerto Montt', 4, 8900.00);

-- Insertar algunos buses de ejemplo
INSERT INTO buses (name, seat_rows, seat_columns) VALUES 
('Bus Premium 001', 10, 4),
('Bus Económico 002', 12, 4),
('Bus VIP 003', 8, 3);

-- Insertar algunos horarios de ejemplo
INSERT INTO schedules (destination_id, bus_id, departure_date, departure_time, arrival_time) VALUES 
(1, 1, '2024-01-15', '08:00:00', '10:00:00'),
(1, 2, '2024-01-15', '14:00:00', '16:00:00'),
(2, 1, '2024-01-16', '09:00:00', '15:00:00'),
(3, 3, '2024-01-17', '10:00:00', '15:00:00'); 