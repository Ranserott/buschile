<?php
$title = 'Seleccionar Asiento - BusChile';
ob_start();
?>

<div class="row">
    <div class="col-lg-8">
        <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                <div class="icon-circle success">
                    <i class="fas fa-chair text-white fs-4"></i>
                </div>
            </div>
            <div>
                <h2 class="mb-1">Seleccionar Asiento</h2>
                <p class="text-muted mb-0">Elige tu asiento preferido para el viaje</p>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header" style="background: var(--primary-gradient); color: white;">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información del Viaje</h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-route text-primary me-3 fs-5"></i>
                            <div>
                                <small class="text-muted d-block">Ruta</small>
                                <strong class="fs-6"><?= htmlspecialchars($schedule['origin']) ?> → <?= htmlspecialchars($schedule['destination']) ?></strong>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-calendar text-success me-3 fs-5"></i>
                            <div>
                                <small class="text-muted d-block">Fecha</small>
                                <strong class="fs-6"><?= date('d/m/Y', strtotime($schedule['departure_date'])) ?></strong>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock text-warning me-3 fs-5"></i>
                            <div>
                                <small class="text-muted d-block">Hora de salida</small>
                                <strong class="fs-6"><?= date('H:i', strtotime($schedule['departure_time'])) ?></strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-bus text-info me-3 fs-5"></i>
                            <div>
                                <small class="text-muted d-block">Bus</small>
                                <strong class="fs-6"><?= htmlspecialchars($schedule['bus_name']) ?></strong>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-hourglass-half text-secondary me-3 fs-5"></i>
                            <div>
                                <small class="text-muted d-block">Duración</small>
                                <strong class="fs-6"><?= $schedule['duration_hours'] ?> horas</strong>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="price-tag">
                                <div class="fw-bold">$<?= number_format($schedule['price'], 0, ',', '.') ?> CLP</div>
                                <small>por persona</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" style="background: var(--success-gradient); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-th me-2"></i>Mapa de Asientos - <?= htmlspecialchars($busLayout['bus']['name']) ?></h5>
                    <span class="badge bg-light text-dark"><?= count($busLayout['layout']) ?> filas</span>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="d-flex gap-4 flex-wrap">
                            <div class="d-flex align-items-center">
                                <span class="seat available me-2">1</span>
                                <small class="fw-semibold">Disponible</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="seat occupied me-2">1</span>
                                <small class="fw-semibold">Ocupado</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="seat selected me-2">1</span>
                                <small class="fw-semibold">Seleccionado</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="small text-muted">
                            <i class="fas fa-steering-wheel me-1"></i>Conductor
                        </div>
                    </div>
                </div>
                
                <div class="bus-layout">
                    <div class="text-center mb-4">
                        <div class="d-inline-block px-4 py-2 rounded-pill" style="background: var(--primary-gradient); color: white;">
                            <i class="fas fa-arrow-up me-2"></i><strong>Frente del Bus</strong>
                        </div>
                    </div>
                    
                    <?php foreach ($busLayout['layout'] as $row => $seats): ?>
                        <div class="seat-row">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="me-3">
                                    <span class="badge bg-secondary">Fila <?= $row ?></span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <?php foreach ($seats as $col => $seatNumber): ?>
                                        <?php 
                                        $isOccupied = in_array($seatNumber, $occupiedSeats);
                                        $seatClass = $isOccupied ? 'occupied' : 'available';
                                        ?>
                                        <span class="seat <?= $seatClass ?>" 
                                              data-seat="<?= $seatNumber ?>"
                                              data-row="<?= $row ?>"
                                              data-col="<?= $col ?>"
                                              <?= !$isOccupied ? 'onclick="selectSeat(' . $seatNumber . ')"' : '' ?>
                                              title="<?= $isOccupied ? 'Asiento ocupado' : 'Asiento disponible - Clic para seleccionar' ?>">
                                            <?= $seatNumber ?>
                                        </span>
                                        <?php if ($col == 2 && count($seats) > 3): ?>
                                            <div class="mx-2 text-muted" style="writing-mode: vertical-lr;">
                                                <small><i class="fas fa-walking"></i></small>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="text-center mt-4">
                        <div class="d-inline-block px-4 py-2 rounded-pill" style="background: var(--secondary-gradient); color: white;">
                            <strong>Parte Trasera del Bus</strong><i class="fas fa-arrow-down ms-2"></i>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <div id="seatSelection" style="display: none;">
                        <div class="alert alert-success border-0" style="background: linear-gradient(135deg, rgba(132, 250, 176, 0.2) 0%, rgba(143, 211, 244, 0.2) 100%);">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>Asiento Seleccionado</h6>
                                    <p class="mb-0">Asiento número <strong id="selectedSeatNumber"></strong> - <span id="seatType"></span></p>
                                </div>
                                <div class="text-end">
                                    <div class="price-tag">
                                        <div class="fw-bold">$<?= number_format($schedule['price'], 0, ',', '.') ?></div>
                                        <small>CLP</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="#" id="confirmSeatBtn" class="btn btn-success btn-lg px-5">
                                <i class="fas fa-check me-2"></i>Confirmar Asiento
                            </a>
                        </div>
                    </div>
                    <div id="noSeatSelected" class="text-center">
                        <div class="py-4">
                            <i class="fas fa-hand-pointer text-muted fs-1 mb-3"></i>
                            <p class="text-muted mb-0">Selecciona un asiento disponible para continuar</p>
                            <small class="text-muted">Los asientos en verde están disponibles</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header" style="background: var(--success-gradient); color: white;">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Tipos de Asiento</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-window-maximize text-primary me-3 mt-1 fs-5"></i>
                    <div>
                        <h6 class="mb-1">Asientos de Ventana</h6>
                        <small class="text-muted">Asientos 1 y 4 de cada fila - Vista panorámica del paisaje</small>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <i class="fas fa-walking text-success me-3 mt-1 fs-5"></i>
                    <div>
                        <h6 class="mb-1">Asientos de Pasillo</h6>
                        <small class="text-muted">Asientos 2 y 3 de cada fila - Fácil acceso al pasillo</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header" style="background: var(--primary-gradient); color: white;">
                <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Recomendaciones</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-arrow-up text-success me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Asientos Delanteros</h6>
                        <small class="text-muted">Mayor espacio para las piernas y menos movimiento</small>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-eye text-info me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Vista Panorámica</h6>
                        <small class="text-muted">Los asientos de ventana ofrecen las mejores vistas</small>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <i class="fas fa-universal-access text-warning me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Fácil Acceso</h6>
                        <small class="text-muted">Los asientos de pasillo facilitan el movimiento</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header" style="background: var(--secondary-gradient); color: white;">
                <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Importante</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning border-0" style="background: rgba(255, 193, 7, 0.1);">
                    <small>
                        <i class="fas fa-lock text-warning me-2"></i>
                        Una vez confirmado el asiento, no podrás cambiarlo. Asegúrate de seleccionar el asiento correcto.
                    </small>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-headset text-primary me-3"></i>
                    <div>
                        <small class="text-muted">¿Necesitas ayuda? Contacta a nuestro equipo de soporte</small>
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
var selectedSeat = null;

function selectSeat(seatNumber) {
    // Remover selección anterior
    $(".seat.selected").removeClass("selected").addClass("available");
    
    // Seleccionar nuevo asiento
    const seatElement = $(".seat[data-seat=\"" + seatNumber + "\"]");
    seatElement.removeClass("available").addClass("selected");
    
    selectedSeat = seatNumber;
    $("#selectedSeatNumber").text(seatNumber);
    
    // Determinar tipo de asiento
    const col = parseInt(seatElement.data("col"));
    let seatType = "";
    if (col === 1 || col === 4) {
        seatType = "Asiento de Ventana";
    } else {
        seatType = "Asiento de Pasillo";
    }
    $("#seatType").text(seatType);
    
    // Mostrar selección con animación
    $("#noSeatSelected").fadeOut(300, function() {
        $("#seatSelection").fadeIn(300);
    });
    
    // Actualizar enlace de confirmación
    $("#confirmSeatBtn").attr("href", "index.php?controller=reservation&action=confirm&schedule_id=' . $_GET['schedule_id'] . '&seat_number=" + seatNumber);
    
    // Efecto visual en el asiento seleccionado
    seatElement.addClass("animate__animated animate__pulse");
    setTimeout(() => {
        seatElement.removeClass("animate__animated animate__pulse");
    }, 1000);
}

// Animación de entrada para los asientos
$(document).ready(function() {
    $(".seat-row").each(function(index) {
        $(this).css("opacity", "0").css("transform", "translateX(-20px)");
        $(this).delay(index * 100).animate({
            opacity: 1
        }, 400, function() {
            $(this).css("transform", "translateX(0)");
        });
    });
    
    // Tooltip para asientos ocupados
    $(".seat.occupied").tooltip({
        title: "Este asiento ya está reservado",
        placement: "top"
    });
    
    // Tooltip para asientos disponibles
    $(".seat.available").tooltip({
        title: "Clic para seleccionar este asiento",
        placement: "top"
    });
});
</script>
';

include __DIR__ . '/../layout.php';
?> 