<?php
$title = 'Gestión de Horarios - Panel de Administración';
$pageTitle = 'Gestión de Horarios';
ob_start();
?>

<?php if (!empty($message)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> <?= htmlspecialchars($message) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Horarios</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ruta</th>
                                <th>Bus</th>
                                <th>Fecha</th>
                                <th>Salida</th>
                                <th>Llegada</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($schedules as $schedule): ?>
                                <tr>
                                    <td><?= $schedule['id'] ?></td>
                                    <td><?= htmlspecialchars($schedule['origin']) ?> → <?= htmlspecialchars($schedule['destination']) ?></td>
                                    <td><?= htmlspecialchars($schedule['bus_name']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($schedule['departure_date'])) ?></td>
                                    <td><?= date('H:i', strtotime($schedule['departure_time'])) ?></td>
                                    <td><?= date('H:i', strtotime($schedule['arrival_time'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $schedule['status'] == 'active' ? 'success' : 'danger' ?>">
                                            <?= $schedule['status'] == 'active' ? 'Activo' : 'Cancelado' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="editSchedule(<?= htmlspecialchars(json_encode($schedule)) ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este horario?')">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= $schedule['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="formTitle">Nuevo Horario</h6>
            </div>
            <div class="card-body">
                <form method="POST" id="scheduleForm">
                    <input type="hidden" name="action" value="create" id="formAction">
                    <input type="hidden" name="id" value="" id="scheduleId">
                    
                    <div class="mb-3">
                        <label for="destination_id" class="form-label">Destino</label>
                        <select class="form-select" id="destination_id" name="destination_id" required>
                            <option value="">Seleccionar destino</option>
                            <?php foreach ($destinations as $destination): ?>
                                <option value="<?= $destination['id'] ?>" data-duration="<?= $destination['duration_hours'] ?>">
                                    <?= htmlspecialchars($destination['origin']) ?> → <?= htmlspecialchars($destination['destination']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="bus_id" class="form-label">Bus</label>
                        <select class="form-select" id="bus_id" name="bus_id" required>
                            <option value="">Seleccionar bus</option>
                            <?php foreach ($buses as $bus): ?>
                                <option value="<?= $bus['id'] ?>">
                                    <?= htmlspecialchars($bus['name']) ?> (<?= $bus['total_seats'] ?> asientos)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="departure_date" class="form-label">Fecha de Salida</label>
                        <input type="date" class="form-control" id="departure_date" name="departure_date" 
                               min="<?= date('Y-m-d') ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="departure_time" class="form-label">Hora de Salida</label>
                        <input type="time" class="form-control" id="departure_time" name="departure_time" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="arrival_time" class="form-label">Hora de Llegada</label>
                        <input type="time" class="form-control" id="arrival_time" name="arrival_time" required>
                        <div class="form-text">Se calculará automáticamente basado en la duración del viaje</div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()" id="cancelBtn" style="display: none;">
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$scripts = '
<script>
function calculateArrivalTime() {
    const departureTime = document.getElementById("departure_time").value;
    const destinationSelect = document.getElementById("destination_id");
    const selectedOption = destinationSelect.options[destinationSelect.selectedIndex];
    
    if (departureTime && selectedOption.dataset.duration) {
        const duration = parseInt(selectedOption.dataset.duration);
        const [hours, minutes] = departureTime.split(":");
        const departureDate = new Date();
        departureDate.setHours(parseInt(hours), parseInt(minutes), 0, 0);
        
        const arrivalDate = new Date(departureDate.getTime() + (duration * 60 * 60 * 1000));
        const arrivalTime = arrivalDate.toTimeString().slice(0, 5);
        
        document.getElementById("arrival_time").value = arrivalTime;
    }
}

document.getElementById("departure_time").addEventListener("change", calculateArrivalTime);
document.getElementById("destination_id").addEventListener("change", calculateArrivalTime);

function editSchedule(schedule) {
    document.getElementById("formTitle").textContent = "Editar Horario";
    document.getElementById("formAction").value = "update";
    document.getElementById("scheduleId").value = schedule.id;
    document.getElementById("destination_id").value = schedule.destination_id;
    document.getElementById("bus_id").value = schedule.bus_id;
    document.getElementById("departure_date").value = schedule.departure_date;
    document.getElementById("departure_time").value = schedule.departure_time;
    document.getElementById("arrival_time").value = schedule.arrival_time;
    document.getElementById("submitBtn").innerHTML = "<i class=\"fas fa-save\"></i> Actualizar";
    document.getElementById("cancelBtn").style.display = "block";
}

function resetForm() {
    document.getElementById("formTitle").textContent = "Nuevo Horario";
    document.getElementById("formAction").value = "create";
    document.getElementById("scheduleId").value = "";
    document.getElementById("scheduleForm").reset();
    document.getElementById("submitBtn").innerHTML = "<i class=\"fas fa-save\"></i> Guardar";
    document.getElementById("cancelBtn").style.display = "none";
}
</script>
';

include 'layout.php';
?> 