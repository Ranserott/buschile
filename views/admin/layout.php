<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Panel de Administración - BusChile' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #2472ab 0%, #1e5a8a 100%);
            --secondary-gradient: linear-gradient(135deg, #2472ab 0%, #3498db 100%);
            --sidebar-bg: linear-gradient(180deg, #1a252f 0%, #2c3e50 100%);
            --accent-color: #2472ab;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .sidebar {
            min-height: 100vh;
            background: var(--sidebar-bg);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar .nav-link {
            color: #cbd5e0;
            padding: 12px 20px;
            margin: 4px 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(36, 114, 171, 0.2);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: var(--primary-gradient);
            box-shadow: 0 4px 15px rgba(36, 114, 171, 0.4);
        }

        .admin-brand {
            background: var(--primary-gradient);
            padding: 20px;
            margin: -12px -12px 20px -12px;
            text-align: center;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 4px 15px rgba(36, 114, 171, 0.3);
        }

        .admin-brand h5 {
            margin: 0;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            background: white;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .card-header {
            background: var(--primary-gradient) !important;
            color: white !important;
            border: none !important;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            padding: 8px 20px;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1e5a8a 0%, #2472ab 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(36, 114, 171, 0.4);
            color: white;
        }

        .btn-outline-primary {
            border-color: var(--accent-color);
            color: var(--accent-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        .page-header {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-left: 4px solid var(--accent-color);
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background: var(--primary-gradient);
            color: white;
            border: none;
            font-weight: 600;
        }

        .alert {
            border: none;
            border-radius: 10px;
            border-left: 4px solid;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(16, 185, 129, 0.1) 100%);
            border-left-color: #22c55e;
        }

        .text-primary {
            color: var(--accent-color) !important;
        }

        .bg-primary {
            background: var(--primary-gradient) !important;
        }

        /* Mejoras para los iconos circulares */
        .icon-circle {
            width: 50px;
            height: 50px;
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
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        }

        .icon-circle.info {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        }

        .icon-circle.warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        /* Mobile navbar para admin */
        .mobile-navbar {
            display: none;
            background: var(--primary-gradient);
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .mobile-navbar .navbar-brand {
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            text-decoration: none;
        }

        .mobile-navbar .navbar-toggler {
            border: 2px solid rgba(255,255,255,0.5);
            padding: 8px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,0.2);
            transition: all 0.3s ease;
            width: 45px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobile-navbar .navbar-toggler:hover,
        .mobile-navbar .navbar-toggler:focus {
            background: rgba(255,255,255,0.3);
            border-color: rgba(255,255,255,0.8);
            box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.25);
        }

        .mobile-navbar .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='3' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            width: 20px;
            height: 15px;
        }

        /* Responsive sidebar */
        @media (max-width: 767.98px) {
            .mobile-navbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 280px;
                height: 100vh;
                z-index: 1050;
                transition: left 0.3s ease;
                overflow-y: auto;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .sidebar-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 1040;
                display: none;
            }
            
            .sidebar-backdrop.show {
                display: block;
            }
            
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                padding-top: 80px; /* Espacio para navbar móvil */
            }
            
            .page-header {
                margin-top: 0;
            }
        }

        @media (min-width: 768px) {
            .mobile-navbar {
                display: none;
            }
            
            .sidebar {
                position: relative;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile navbar (solo visible en móviles) -->
    <nav class="mobile-navbar">
        <a class="navbar-brand" href="index.php?controller=admin&action=dashboard">
            <i class="fas fa-bus me-2"></i>BusChile Admin
        </a>
        <button class="navbar-toggler" type="button" id="sidebarToggle">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <!-- Backdrop para cerrar sidebar en móvil -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar" id="sidebar">
                <div class="position-sticky pt-3">
                    <div class="admin-brand">
                        <h5><i class="fas fa-bus me-2"></i>BusChile</h5>
                        <small class="text-light">Panel de Administración</small>
                        <div class="mt-2">
                            <small class="text-light opacity-75">
                                <i class="fas fa-user-shield me-1"></i>
                                <?= $_SESSION['admin_username'] ?? 'Admin' ?>
                            </small>
                        </div>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=admin&action=dashboard">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=admin&action=destinations">
                                <i class="fas fa-map-marker-alt me-2"></i> Destinos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=admin&action=buses">
                                <i class="fas fa-bus me-2"></i> Buses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=admin&action=schedules">
                                <i class="fas fa-calendar-alt me-2"></i> Horarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=admin&action=reservations">
                                <i class="fas fa-ticket-alt me-2"></i> Reservas
                            </a>
                        </li>
                    </ul>
                    
                    <hr class="text-white-50 mx-3">
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <i class="fas fa-external-link-alt me-2"></i> Ver Sitio Web
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="index.php?controller=admin&action=logout">
                                <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h2 mb-0"><?= $pageTitle ?? 'Panel de Administración' ?></h1>
                        <div class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            <?= date('d/m/Y H:i') ?>
                        </div>
                    </div>
                </div>

                <?= $content ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        // JavaScript para manejo del sidebar móvil
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');
            
            // Función para mostrar sidebar
            function showSidebar() {
                sidebar.classList.add('show');
                sidebarBackdrop.classList.add('show');
                document.body.style.overflow = 'hidden';
                console.log('Sidebar abierto');
            }
            
            // Función para ocultar sidebar
            function hideSidebar() {
                sidebar.classList.remove('show');
                sidebarBackdrop.classList.remove('show');
                document.body.style.overflow = '';
                console.log('Sidebar cerrado');
            }
            
            // Toggle del botón hamburguesa
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    console.log('Botón hamburguesa clickeado');
                    if (sidebar.classList.contains('show')) {
                        hideSidebar();
                    } else {
                        showSidebar();
                    }
                });
            }
            
            // Cerrar sidebar al hacer clic en el backdrop
            if (sidebarBackdrop) {
                sidebarBackdrop.addEventListener('click', function() {
                    hideSidebar();
                });
            }
            
            // Cerrar sidebar al hacer clic en un enlace (solo en móvil)
            const sidebarLinks = sidebar.querySelectorAll('.nav-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        setTimeout(hideSidebar, 100); // Pequeño delay para permitir la navegación
                    }
                });
            });
            
            // Manejar cambio de tamaño de ventana
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    // En desktop: asegurar que el sidebar esté visible y remover clases móviles
                    sidebar.classList.remove('show');
                    sidebarBackdrop.classList.remove('show');
                    document.body.style.overflow = '';
                } else {
                    // En móvil: asegurar que el sidebar esté oculto
                    sidebar.classList.remove('show');
                    sidebarBackdrop.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
            
            // Debug
            console.log('Admin panel mobile navigation initialized');
            console.log('Sidebar toggle:', sidebarToggle ? 'found' : 'not found');
            console.log('Sidebar:', sidebar ? 'found' : 'not found');
        });
    </script>
    <?= $scripts ?? '' ?>
</body>
</html> 