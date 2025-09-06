<?php
$title = 'Buscar Viajes - BusChile';
ob_start();
?>

<div class="row">
    <div class="col-lg-8">
        <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                <div class="icon-circle primary">
                    <i class="fas fa-search text-white fs-4"></i>
                </div>
            </div>
            <div>
                <h2 class="mb-1">Buscar Viajes</h2>
                <p class="text-muted mb-0">Encuentra el viaje perfecto para tu destino</p>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header" style="background: var(--primary-gradient); color: white;">
                <h5 class="mb-0"><i class="fas fa-route me-2"></i>Planifica tu Viaje</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" id="searchForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="origin" class="form-label fw-semibold">
                                <i class="fas fa-map-marker-alt text-primary me-1"></i>Ciudad de Origen
                            </label>
                            <select class="form-select" id="origin" name="origin" required>
                                <option value="">Selecciona tu ciudad de origen</option>
                                <?php foreach ($origins as $origin): ?>
                                    <option value="<?= htmlspecialchars($origin) ?>" 
                                            <?= (isset($_POST['origin']) && $_POST['origin'] == $origin) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($origin) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="destination" class="form-label fw-semibold">
                                <i class="fas fa-flag-checkered text-success me-1"></i>Ciudad de Destino
                            </label>
                            <select class="form-select" id="destination" name="destination" required>
                                <option value="">Selecciona tu destino</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label for="date" class="form-label fw-semibold">
                                <i class="fas fa-calendar-alt text-info me-1"></i>Fecha de Viaje (opcional)
                            </label>
                            <input type="date" class="form-control" id="date" name="date" 
                                   min="<?= date('Y-m-d') ?>" 
                                   value="<?= $_POST['date'] ?? '' ?>">
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-2"></i>Buscar Viajes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i><?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($schedules)): ?>
            <div class="mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4 class="mb-0">
                        <i class="fas fa-bus text-primary me-2"></i>Viajes Disponibles
                    </h4>
                    <span class="badge bg-primary rounded-pill"><?= count($schedules) ?> resultados</span>
                </div>
                
                <?php foreach ($schedules as $index => $schedule): ?>
                    <div class="card mb-3 trip-card" style="animation-delay: <?= $index * 0.1 ?>s;">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <div class="icon-circle success" style="width: 50px; height: 50px;">
                                                <i class="fas fa-bus text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">
                                                <?= htmlspecialchars($schedule['origin']) ?> 
                                                <i class="fas fa-arrow-right text-primary mx-2"></i>
                                                <?= htmlspecialchars($schedule['destination']) ?>
                                            </h5>
                                            <p class="text-muted mb-0"><?= htmlspecialchars($schedule['bus_name']) ?></p>
                                        </div>
                                    </div>
                                    
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-calendar text-primary me-2"></i>
                                                <div>
                                                    <small class="text-muted d-block">Fecha</small>
                                                    <strong><?= date('d/m/Y', strtotime($schedule['departure_date'])) ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-clock text-success me-2"></i>
                                                <div>
                                                    <small class="text-muted d-block">Salida</small>
                                                    <strong><?= date('H:i', strtotime($schedule['departure_time'])) ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-hourglass-half text-warning me-2"></i>
                                                <div>
                                                    <small class="text-muted d-block">Duración</small>
                                                    <strong><?= $schedule['duration_hours'] ?> horas</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-chair text-info me-2"></i>
                                                <div>
                                                    <small class="text-muted d-block">Asientos disponibles</small>
                                                    <strong><?= ($schedule['total_seats'] - $schedule['occupied_seats']) ?> de <?= $schedule['total_seats'] ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="price-tag mb-3">
                                        <div class="fs-4 fw-bold">$<?= number_format($schedule['price'], 0, ',', '.') ?></div>
                                        <small>CLP por persona</small>
                                    </div>
                                    <a href="index.php?controller=reservation&action=select_seat&schedule_id=<?= $schedule['id'] ?>" 
                                       class="btn btn-success w-100">
                                        <i class="fas fa-chair me-2"></i>Seleccionar Asiento
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header" style="background: var(--success-gradient); color: white;">
                <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Consejos de Viaje</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-clock text-primary me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Reserva con Anticipación</h6>
                        <small class="text-muted">Obtén mejores precios reservando con tiempo</small>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-window-maximize text-success me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Asientos de Ventana</h6>
                        <small class="text-muted">Los asientos con vista se agotan rápidamente</small>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-user-clock text-warning me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Llega Temprano</h6>
                        <small class="text-muted">Presenta tu reserva 15 minutos antes</small>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <i class="fas fa-bookmark text-info me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Guarda tu Reserva</h6>
                        <small class="text-muted">Conserva tu número de confirmación</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" style="background: var(--secondary-gradient); color: white;">
                <h5 class="mb-0"><i class="fas fa-map-marked-alt me-2"></i>Destinos Populares</h5>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-6">
                        <div class="text-center p-2 rounded" style="background: rgba(102, 126, 234, 0.1);">
                            <i class="fas fa-city text-primary fs-4 mb-1"></i>
                            <div class="small fw-semibold">Santiago</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-2 rounded" style="background: rgba(79, 172, 254, 0.1);">
                            <i class="fas fa-anchor text-info fs-4 mb-1"></i>
                            <div class="small fw-semibold">Valparaíso</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-2 rounded" style="background: rgba(132, 250, 176, 0.1);">
                            <i class="fas fa-mountain text-success fs-4 mb-1"></i>
                            <div class="small fw-semibold">Concepción</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-2 rounded" style="background: rgba(240, 147, 251, 0.1);">
                            <i class="fas fa-sun text-warning fs-4 mb-1"></i>
                            <div class="small fw-semibold">La Serena</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$scripts = '
<script>
$(document).ready(function() {
    // Animación de entrada para las tarjetas
    $(".trip-card").each(function(index) {
        $(this).css("opacity", "0").css("transform", "translateY(20px)");
        $(this).delay(index * 100).animate({
            opacity: 1
        }, 600).css("transform", "translateY(0)");
    });

    $("#origin").change(function() {
        var origin = $(this).val();
        if (origin) {
            // Mostrar loading
            $("#destination").html("<option value=\"\">Cargando destinos...</option>");
            
            $.get("index.php?controller=reservation&action=search&ajax=destinations&origin=" + encodeURIComponent(origin))
                .done(function(data) {
                    var destinationSelect = $("#destination");
                    destinationSelect.empty();
                    destinationSelect.append("<option value=\"\">Selecciona tu destino</option>");
                    
                    $.each(data, function(index, destination) {
                        destinationSelect.append("<option value=\"" + destination + "\">" + destination + "</option>");
                    });
                    
                    // Seleccionar destino previo si existe
                    var selectedDestination = "' . ($_POST['destination'] ?? '') . '";
                    if (selectedDestination) {
                        destinationSelect.val(selectedDestination);
                    }
                })
                .fail(function() {
                    $("#destination").html("<option value=\"\">Error al cargar destinos</option>");
                });
        } else {
            $("#destination").empty().append("<option value=\"\">Selecciona tu destino</option>");
        }
    });
    
    // Cargar destinos si hay origen seleccionado
    if ($("#origin").val()) {
        $("#origin").trigger("change");
    }
});
</script>
';

include __DIR__ . '/../layout.php';
?> 