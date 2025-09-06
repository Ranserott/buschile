<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistema de Reservas de Buses' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #93c663 0%, #7fb142 100%);
            --secondary-gradient: linear-gradient(135deg, #93c663 0%, #a8d373 100%);
            --success-gradient: linear-gradient(135deg, #93c663 0%, #7fb142 100%);
            --accent-color: #93c663;
            --card-shadow: 0 10px 30px rgba(0,0,0,0.1);
            --card-hover-shadow: 0 20px 40px rgba(0,0,0,0.15);
            --border-radius: 16px;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8fdf4 0%, #e8f5d8 100%);
            min-height: 100vh;
        }

        .navbar {
            background: var(--primary-gradient) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: none;
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0 4px;
            padding: 8px 16px !important;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.95);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-hover-shadow);
        }

        .card-header {
            border: none;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
            font-weight: 600;
            padding: 1.5rem;
        }

        .btn {
            border-radius: 12px;
            font-weight: 500;
            padding: 12px 24px;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: var(--primary-gradient);
            box-shadow: 0 4px 15px rgba(147, 198, 99, 0.4);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #7fb142 0%, #93c663 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(147, 198, 99, 0.6);
            color: white;
        }

        .btn-success {
            background: var(--success-gradient);
            box-shadow: 0 4px 15px rgba(147, 198, 99, 0.4);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #7fb142 0%, #93c663 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(147, 198, 99, 0.6);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #92400e;
            box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }

        .seat {
            width: 45px;
            height: 45px;
            margin: 3px;
            border: none;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .seat::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.3));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .seat:hover::before {
            opacity: 1;
        }

        .seat.available {
            background: linear-gradient(135deg, #93c663 0%, #a8d373 100%);
            color: #365314;
            box-shadow: 0 4px 15px rgba(147, 198, 99, 0.3);
        }

        .seat.available:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(147, 198, 99, 0.5);
        }

        .seat.occupied {
            background: linear-gradient(135deg, #f87171 0%, #fca5a5 100%);
            color: #7f1d1d;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .seat.selected {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.5);
        }

        .bus-layout {
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(248,253,244,0.9) 100%);
            padding: 2rem;
            border-radius: var(--border-radius);
            margin: 20px 0;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(147, 198, 99, 0.2);
        }

        .alert {
            border: none;
            border-radius: var(--border-radius);
            backdrop-filter: blur(10px);
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(147, 198, 99, 0.2) 0%, rgba(168, 211, 115, 0.2) 100%);
            border-left: 4px solid var(--accent-color);
        }

        .alert-info {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(147, 197, 253, 0.2) 100%);
            border-left: 4px solid #3b82f6;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(252, 165, 165, 0.2) 100%);
            border-left: 4px solid #ef4444;
        }

        .form-control, .form-select {
            border: 2px solid rgba(147, 198, 99, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.9);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(147, 198, 99, 0.25);
            background: white;
        }

        .price-tag {
            background: var(--success-gradient);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(147, 198, 99, 0.3);
        }

        footer {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            margin-top: 4rem;
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .seat-row {
            margin-bottom: 1rem;
            padding: 1rem;
            background: rgba(255,255,255,0.5);
            border-radius: 12px;
            backdrop-filter: blur(5px);
        }

        .trip-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .trip-card:hover {
            border-left-color: var(--accent-color);
            transform: translateX(5px);
        }

        /* Iconos circulares para el sitio público */
        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .icon-circle.primary {
            background: var(--primary-gradient);
        }

        .icon-circle.success {
            background: var(--success-gradient);
        }

        .icon-circle.info {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }

        .icon-circle.warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .navbar-toggler {
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            background: rgba(255,255,255,0.3);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.25);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.95%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        @media (max-width: 768px) {
            .seat {
                width: 35px;
                height: 35px;
                font-size: 11px;
            }
            
            .card {
                margin-bottom: 1rem;
            }
            
            .navbar-collapse {
                background: rgba(0,0,0,0.1);
                border-radius: 12px;
                padding: 1rem;
                margin-top: 1rem;
                backdrop-filter: blur(10px);
            }
            
            .navbar-nav .nav-link {
                padding: 12px 16px !important;
                margin: 4px 0;
                border-radius: 8px;
                transition: all 0.3s ease;
            }
            
            .navbar-nav .nav-link:hover {
                background: rgba(255,255,255,0.2);
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-bus me-2"></i>BusChile
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-home me-1"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=reservation&action=search">
                            <i class="fas fa-search me-1"></i>Buscar Viajes
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=admin&action=login">
                            <i class="fas fa-user-shield me-1"></i>Administración
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4 fade-in">
        <?= $content ?>
    </main>

    <footer class="text-light text-center py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-bus me-2"></i>BusChile</h5>
                </div>
                <div class="col-md-4">
                    <p class="mb-0">&copy; 2025 BusChile. Todos los derechos reservados.</p>                </div>
                <div class="col-md-4">
                    <small class="text-light">
                        <i class="fas fa-code me-1"></i>Creado por 
                        <a href="https://bytea.cl" target="_blank" class="text-light text-decoration-none">
                            <strong>Bytea</strong>
                        </a>
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        // Mejorar la funcionalidad del menú móvil
        $(document).ready(function() {
            // Cerrar el menú al hacer clic en un enlace (solo en móviles)
            $('.navbar-nav .nav-link').on('click', function() {
                if (window.innerWidth < 992) {
                    $('.navbar-collapse').collapse('hide');
                }
            });
            
            // Cerrar el menú al hacer clic fuera de él
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.navbar').length) {
                    $('.navbar-collapse').collapse('hide');
                }
            });
            
            // Animación suave para el toggle
            $('.navbar-toggler').on('click', function() {
                $(this).addClass('active');
                setTimeout(() => {
                    $(this).removeClass('active');
                }, 300);
            });
        });
    </script>
    <?= $scripts ?? '' ?>
</body>
</html> 