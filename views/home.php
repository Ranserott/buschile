<?php
$title = 'Inicio - BusChile';
ob_start();
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0" style="background: var(--primary-gradient); color: white;">
            <div class="card-body p-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="icon-circle" style="background: rgba(255,255,255,0.2); margin-right: 20px;">
                        <i class="fas fa-bus text-white fs-2"></i>
                    </div>
                    <div>
                        <h1 class="display-4 mb-2">¡Bienvenido a BusChile!</h1>
                        <p class="lead mb-0">Tu viaje, nuestra pasión</p>
                    </div>
                </div>
                <p class="lead mb-4">Reserva tu asiento de manera fácil y rápida. Conectamos Chile de norte a sur con los mejores horarios y precios para tu viaje.</p>
                <hr class="my-4" style="border-color: rgba(255,255,255,0.3);">
                <p class="mb-4">Selecciona tu origen y destino para comenzar a buscar viajes disponibles por todo Chile.</p>
                <a class="btn btn-light btn-lg px-4" href="index.php?controller=reservation&action=search" role="button">
                    <i class="fas fa-search me-2"></i>Buscar Viajes
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header" style="background: var(--success-gradient); color: white;">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información</h5>
            </div>
            <div class="card-body">
                <h6 class="text-primary"><i class="fas fa-route me-2"></i>¿Cómo reservar?</h6>
                <ol class="small mb-4">
                    <li>Busca tu viaje por origen y destino</li>
                    <li>Selecciona el horario que prefieras</li>
                    <li>Elige tu asiento en el mapa del bus</li>
                    <li>Completa tus datos y confirma</li>
                </ol>
                
                <hr>
                
                <h6 class="text-primary"><i class="fas fa-map-marked-alt me-2"></i>Destinos Disponibles</h6>
                <div class="small">
                    <?php if (!empty($origins)): ?>
                        <?php foreach ($origins as $origin): ?>
                            <span class="badge" style="background: var(--accent-color); color: white; margin-right: 4px; margin-bottom: 4px;"><?= htmlspecialchars($origin) ?></span>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">No hay destinos disponibles</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-4 mb-4">
        <div class="card h-100 text-center">
            <div class="card-body">
                <div class="icon-circle primary mx-auto mb-3">
                    <i class="fas fa-clock text-white fs-3"></i>
                </div>
                <h5 class="card-title">Horarios Flexibles</h5>
                <p class="card-text">Múltiples horarios disponibles para que elijas el que mejor se adapte a tus necesidades de viaje.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100 text-center">
            <div class="card-body">
                <div class="icon-circle success mx-auto mb-3">
                    <i class="fas fa-shield-alt text-white fs-3"></i>
                </div>
                <h5 class="card-title">Reserva Segura</h5>
                <p class="card-text">Sistema seguro de reservas con confirmación inmediata por email y soporte 24/7.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100 text-center">
            <div class="card-body">
                <div class="icon-circle warning mx-auto mb-3">
                    <i class="fas fa-money-bill-wave text-white fs-3"></i>
                </div>
                <h5 class="card-title">Mejores Precios</h5>
                <p class="card-text">Precios competitivos en pesos chilenos y transparentes sin costos ocultos.</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="background: var(--primary-gradient); color: white;">
                <h5 class="mb-0"><i class="fas fa-star me-2"></i>¿Por qué elegir BusChile?</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-check-circle text-success me-3 mt-1 fs-5"></i>
                            <div>
                                <h6 class="mb-1">Cobertura Nacional</h6>
                                <small class="text-muted">Conectamos las principales ciudades de Chile</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-check-circle text-success me-3 mt-1 fs-5"></i>
                            <div>
                                <h6 class="mb-1">Buses Modernos</h6>
                                <small class="text-muted">Flota renovada con todas las comodidades</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="fas fa-check-circle text-success me-3 mt-1 fs-5"></i>
                            <div>
                                <h6 class="mb-1">Puntualidad Garantizada</h6>
                                <small class="text-muted">Cumplimos con los horarios establecidos</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-check-circle text-success me-3 mt-1 fs-5"></i>
                            <div>
                                <h6 class="mb-1">Atención al Cliente</h6>
                                <small class="text-muted">Soporte personalizado antes, durante y después del viaje</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-check-circle text-success me-3 mt-1 fs-5"></i>
                            <div>
                                <h6 class="mb-1">Reserva Online</h6>
                                <small class="text-muted">Sistema fácil e intuitivo disponible 24/7</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="fas fa-check-circle text-success me-3 mt-1 fs-5"></i>
                            <div>
                                <h6 class="mb-1">Precios Justos</h6>
                                <small class="text-muted">Tarifas competitivas sin sorpresas</small>
                            </div>
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