<?php
$title = 'Dashboard - Panel de Administración BusChile';
$pageTitle = 'Dashboard';
ob_start();
?>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Reservas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalReservations ?></div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle primary">
                            <i class="fas fa-ticket-alt text-white fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Destinos Activos
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalDestinations ?></div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle success">
                            <i class="fas fa-map-marker-alt text-white fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Flota de Buses
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBuses ?></div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle info">
                            <i class="fas fa-bus text-white fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Horarios Programados
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalSchedules ?></div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle warning">
                            <i class="fas fa-calendar-alt text-white fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-bolt me-2"></i>Acciones Rápidas</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="index.php?controller=admin&action=destinations" class="btn btn-outline-primary d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-3"></i>
                        <div class="text-start">
                            <div class="fw-bold">Gestionar Destinos</div>
                            <small class="text-muted">Crear y editar rutas de viaje</small>
                        </div>
                    </a>
                    <a href="index.php?controller=admin&action=buses" class="btn btn-outline-success d-flex align-items-center">
                        <i class="fas fa-bus me-3"></i>
                        <div class="text-start">
                            <div class="fw-bold">Gestionar Buses</div>
                            <small class="text-muted">Configurar flota y asientos</small>
                        </div>
                    </a>
                    <a href="index.php?controller=admin&action=schedules" class="btn btn-outline-info d-flex align-items-center">
                        <i class="fas fa-calendar-alt me-3"></i>
                        <div class="text-start">
                            <div class="fw-bold">Gestionar Horarios</div>
                            <small class="text-muted">Programar viajes y horarios</small>
                        </div>
                    </a>
                    <a href="index.php?controller=admin&action=reservations" class="btn btn-outline-warning d-flex align-items-center">
                        <i class="fas fa-ticket-alt me-3"></i>
                        <div class="text-start">
                            <div class="fw-bold">Ver Reservas</div>
                            <small class="text-muted">Monitorear reservas de clientes</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-info-circle me-2"></i>Información del Sistema</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <div style="width: 80px; height: 80px; background: var(--primary-gradient); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; box-shadow: 0 8px 25px rgba(36, 114, 171, 0.3);">
                        <i class="fas fa-bus text-white fs-1"></i>
                    </div>
                    <h5 class="mt-3 mb-1">¡Bienvenido a BusChile!</h5>
                    <p class="text-muted">Panel de Administración</p>
                </div>
                
                <div class="alert alert-info border-0" style="background: linear-gradient(135deg, rgba(36, 114, 171, 0.1) 0%, rgba(52, 152, 219, 0.1) 100%); border-left: 4px solid var(--accent-color);">
                    <h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2"></i>Funciones Principales</h6>
                    <ul class="small mb-0 ps-3">
                        <li><strong>Destinos:</strong> Gestiona rutas entre ciudades chilenas</li>
                        <li><strong>Buses:</strong> Configura tu flota y distribución de asientos</li>
                        <li><strong>Horarios:</strong> Programa viajes y horarios de salida</li>
                        <li><strong>Reservas:</strong> Supervisa las reservas de pasajeros</li>
                    </ul>
                </div>
                
                <div class="text-center">
                    <a href="index.php" class="btn btn-outline-secondary">
                        <i class="fas fa-external-link-alt me-2"></i>Ver Sitio Público
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-chart-line me-2"></i>Resumen de Actividad</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="p-3">
                            <i class="fas fa-users text-primary fs-2 mb-2"></i>
                            <h6 class="text-muted">Pasajeros Atendidos</h6>
                            <h4 class="text-primary"><?= $totalReservations ?></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <i class="fas fa-route text-success fs-2 mb-2"></i>
                            <h6 class="text-muted">Rutas Disponibles</h6>
                            <h4 class="text-success"><?= $totalDestinations ?></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <i class="fas fa-clock text-info fs-2 mb-2"></i>
                            <h6 class="text-muted">Viajes Programados</h6>
                            <h4 class="text-info"><?= $totalSchedules ?></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <i class="fas fa-star text-warning fs-2 mb-2"></i>
                            <h6 class="text-muted">Sistema Activo</h6>
                            <h4 class="text-warning">24/7</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?> 