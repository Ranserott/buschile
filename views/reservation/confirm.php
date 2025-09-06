<?php
$title = 'Confirmar Reserva - BusChile';
ob_start();
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                <div class="icon-circle success">
                    <i class="fas fa-check-circle text-white fs-4"></i>
                </div>
            </div>
            <div>
                <h2 class="mb-1">Confirmar Reserva</h2>
                <p class="text-muted mb-0">Revisa los detalles y completa tu reserva</p>
            </div>
        </div>
        
        <?php if (isset($success) && $success): ?>
            <div class="card border-0" style="background: linear-gradient(135deg, rgba(132, 250, 176, 0.1) 0%, rgba(143, 211, 244, 0.1) 100%);">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <div class="icon-circle success" style="width: 80px; height: 80px; margin: 0 auto;">
                            <i class="fas fa-check text-white fs-1"></i>
                        </div>
                    </div>
                    <h3 class="text-success mb-3">¡Reserva Confirmada!</h3>
                    <p class="lead mb-4"><?= htmlspecialchars($message) ?></p>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body text-start">
                                    <h6 class="text-muted mb-3"><i class="fas fa-user me-2"></i>Datos del Pasajero</h6>
                                    <p class="mb-2"><strong>Nombre:</strong> <?= htmlspecialchars($reservation['customer_name']) ?></p>
                                    <p class="mb-2"><strong>Email:</strong> <?= htmlspecialchars($reservation['customer_email']) ?></p>
                                    <p class="mb-0"><strong>Asiento:</strong> <span class="badge bg-primary"><?= $reservation['seat_number'] ?></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body text-start">
                                    <h6 class="text-muted mb-3"><i class="fas fa-route me-2"></i>Detalles del Viaje</h6>
                                    <p class="mb-2"><strong>Ruta:</strong> <?= htmlspecialchars($reservation['origin']) ?> → <?= htmlspecialchars($reservation['destination']) ?></p>
                                    <p class="mb-2"><strong>Fecha:</strong> <?= date('d/m/Y', strtotime($reservation['departure_date'])) ?></p>
                                    <p class="mb-0"><strong>Hora:</strong> <?= date('H:i', strtotime($reservation['departure_time'])) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="index.php" class="btn btn-primary px-4">
                            <i class="fas fa-home me-2"></i>Volver al Inicio
                        </a>
                        <a href="index.php?controller=reservation&action=search" class="btn btn-outline-primary px-4">
                            <i class="fas fa-search me-2"></i>Nueva Búsqueda
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php if (!empty($message)): ?>
                <div class="alert alert-danger border-0">
                    <i class="fas fa-exclamation-triangle me-2"></i><?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            
            <div class="card mb-4">
                <div class="card-header" style="background: var(--primary-gradient); color: white;">
                    <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Resumen del Viaje</h5>
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
                                <i class="fas fa-chair text-secondary me-3 fs-5"></i>
                                <div>
                                    <small class="text-muted d-block">Asiento seleccionado</small>
                                    <span class="badge bg-primary fs-6"><?= htmlspecialchars($seatNumber) ?></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-money-bill-wave text-success me-3 fs-5"></i>
                                <div>
                                    <small class="text-muted d-block">Precio total</small>
                                    <div class="price-tag">
                                        <div class="fw-bold">$<?= number_format($schedule['price'], 0, ',', '.') ?> CLP</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" style="background: var(--success-gradient); color: white;">
                    <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i>Datos del Pasajero</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" id="reservationForm">
                        <input type="hidden" name="schedule_id" value="<?= htmlspecialchars($scheduleId) ?>">
                        <input type="hidden" name="seat_number" value="<?= htmlspecialchars($seatNumber) ?>">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="customer_name" class="form-label fw-semibold">
                                    <i class="fas fa-user text-primary me-1"></i>Nombre Completo *
                                </label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" 
                                       value="<?= htmlspecialchars($_POST['customer_name'] ?? '') ?>" 
                                       placeholder="Ingresa tu nombre completo" required>
                            </div>
                            <div class="col-md-6">
                                <label for="customer_email" class="form-label fw-semibold">
                                    <i class="fas fa-envelope text-success me-1"></i>Correo Electrónico *
                                </label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email" 
                                       value="<?= htmlspecialchars($_POST['customer_email'] ?? '') ?>" 
                                       placeholder="ejemplo@correo.com" required>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    <i class="fas fa-shield-alt text-info me-1"></i>
                                    Acepto los <a href="#" class="text-decoration-none">términos y condiciones</a> del servicio *
                                </label>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3 justify-content-end mt-4">
                            <a href="index.php?controller=reservation&action=select_seat&schedule_id=<?= $scheduleId ?>" 
                               class="btn btn-outline-secondary px-4">
                                <i class="fas fa-arrow-left me-2"></i>Cambiar Asiento
                            </a>
                            <button type="submit" class="btn btn-success btn-lg px-5">
                                <i class="fas fa-credit-card me-2"></i>Confirmar Reserva
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header" style="background: var(--primary-gradient); color: white;">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información Importante</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Confirmación Inmediata</h6>
                        <small class="text-muted">Las reservas son confirmadas al instante</small>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-envelope text-info me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Email de Confirmación</h6>
                        <small class="text-muted">Recibirás todos los detalles por correo</small>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-clock text-warning me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Llegada Temprana</h6>
                        <small class="text-muted">Presenta tu reserva 15 minutos antes</small>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <i class="fas fa-id-card text-primary me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Identificación</h6>
                        <small class="text-muted">Presenta tu ID de reserva al conductor</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" style="background: var(--secondary-gradient); color: white;">
                <h5 class="mb-0"><i class="fas fa-ban me-2"></i>Política de Cancelación</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning border-0" style="background: rgba(255, 193, 7, 0.1);">
                    <small>
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        Las cancelaciones deben realizarse con al menos 2 horas de anticipación.
                    </small>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-headset text-primary me-3"></i>
                    <div>
                        <small class="text-muted">
                            Para cancelaciones, contacta a nuestro equipo de soporte o al administrador del sistema.
                        </small>
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
    $("#reservationForm").submit(function(e) {
        if (!$("#terms").is(":checked")) {
            e.preventDefault();
            
            // Mostrar alerta moderna
            const alert = `
                <div class="alert alert-warning alert-dismissible fade show border-0" style="background: rgba(255, 193, 7, 0.1);">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Debes aceptar los términos y condiciones para continuar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            $("#reservationForm").prepend(alert);
            $("#terms").focus();
            return false;
        }
        
        // Confirmar antes de enviar
        if (!confirm("¿Estás seguro de que deseas confirmar esta reserva?")) {
            e.preventDefault();
            return false;
        }
        
        // Mostrar loading en el botón
        const submitBtn = $(this).find("button[type=submit]");
        const originalText = submitBtn.html();
        submitBtn.html("<i class=\"fas fa-spinner fa-spin me-2\"></i>Procesando...").prop("disabled", true);
        
        // Si hay error, restaurar el botón después de 3 segundos
        setTimeout(() => {
            submitBtn.html(originalText).prop("disabled", false);
        }, 3000);
    });
    
    // Validación en tiempo real
    $("#customer_name").on("input", function() {
        const value = $(this).val().trim();
        if (value.length < 2) {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid").addClass("is-valid");
        }
    });
    
    $("#customer_email").on("input", function() {
        const value = $(this).val();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid").addClass("is-valid");
        }
    });
});
</script>
';

include __DIR__ . '/../layout.php';
?> 