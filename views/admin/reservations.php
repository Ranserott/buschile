<?php
$title = 'Gestión de Reservas - Panel de Administración';
$pageTitle = 'Gestión de Reservas';
ob_start();
?>

<?php if (!empty($message)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> <?= htmlspecialchars($message) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Reservas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Ruta</th>
                        <th>Bus</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Asiento</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Fecha Reserva</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr class="<?= $reservation['status'] == 'cancelled' ? 'table-secondary' : '' ?>">
                            <td><?= $reservation['id'] ?></td>
                            <td><?= htmlspecialchars($reservation['customer_name']) ?></td>
                            <td><?= htmlspecialchars($reservation['customer_email']) ?></td>
                            <td><?= htmlspecialchars($reservation['origin']) ?> → <?= htmlspecialchars($reservation['destination']) ?></td>
                            <td><?= htmlspecialchars($reservation['bus_name']) ?></td>
                            <td><?= date('d/m/Y', strtotime($reservation['departure_date'])) ?></td>
                            <td><?= date('H:i', strtotime($reservation['departure_time'])) ?></td>
                            <td>
                                <span class="badge bg-info"><?= $reservation['seat_number'] ?></span>
                            </td>
                            <td>
                                <span class="text-success fw-bold">$<?= number_format($reservation['price'] ?? 0, 0, ',', '.') ?></span>
                            </td>
                            <td>
                                <span class="badge bg-<?= $reservation['status'] == 'confirmed' ? 'success' : 'danger' ?>">
                                    <?= $reservation['status'] == 'confirmed' ? 'Confirmada' : 'Cancelada' ?>
                                </span>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($reservation['created_at'])) ?></td>
                            <td>
                                <?php if ($reservation['status'] == 'confirmed'): ?>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de cancelar esta reserva?')">
                                        <input type="hidden" name="action" value="cancel">
                                        <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-warning" title="Cancelar reserva">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted">Cancelada</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?php if (empty($reservations)): ?>
            <div class="text-center py-4">
                <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No hay reservas registradas</h5>
                <p class="text-muted">Las reservas aparecerán aquí cuando los clientes realicen reservas.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-success"><?= count(array_filter($reservations, fn($r) => $r['status'] == 'confirmed')) ?></h5>
                <p class="card-text">Reservas Confirmadas</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-danger"><?= count(array_filter($reservations, fn($r) => $r['status'] == 'cancelled')) ?></h5>
                <p class="card-text">Reservas Canceladas</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-primary"><?= count($reservations) ?></h5>
                <p class="card-text">Total Reservas</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-info">
                    $<?= number_format(array_sum(array_map(fn($r) => $r['status'] == 'confirmed' ? ($r['price'] ?? 0) : 0, $reservations)), 0, ',', '.') ?> CLP
                </h5>
                <p class="card-text">Ingresos Totales</p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?> 