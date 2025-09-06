<?php
$title = 'Gestión de Buses - Panel de Administración';
$pageTitle = 'Gestión de Buses';
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
                <h6 class="m-0 font-weight-bold text-primary">Lista de Buses</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Filas</th>
                                <th>Columnas</th>
                                <th>Total Asientos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($buses as $bus): ?>
                                <tr>
                                    <td><?= $bus['id'] ?></td>
                                    <td><?= htmlspecialchars($bus['name']) ?></td>
                                    <td><?= $bus['seat_rows'] ?></td>
                                    <td><?= $bus['seat_columns'] ?></td>
                                    <td><?= $bus['total_seats'] ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="editBus(<?= htmlspecialchars(json_encode($bus)) ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este bus?')">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= $bus['id'] ?>">
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
                <h6 class="m-0 font-weight-bold text-primary" id="formTitle">Nuevo Bus</h6>
            </div>
            <div class="card-body">
                <form method="POST" id="busForm">
                    <input type="hidden" name="action" value="create" id="formAction">
                    <input type="hidden" name="id" value="" id="busId">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del Bus</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="seat_rows" class="form-label">Número de Filas</label>
                        <input type="number" class="form-control" id="seat_rows" name="seat_rows" min="5" max="20" value="10" required>
                        <div class="form-text">Entre 5 y 20 filas</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="seat_columns" class="form-label">Asientos por Fila</label>
                        <select class="form-select" id="seat_columns" name="seat_columns" required>
                            <option value="3">3 asientos (1-2)</option>
                            <option value="4" selected>4 asientos (2-2)</option>
                            <option value="5">5 asientos (2-3)</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <div class="alert alert-info">
                            <small>
                                <strong>Total de asientos:</strong> <span id="totalSeats">40</span><br>
                                <strong>Configuración:</strong> <span id="seatConfig">2-2 (pasillo en el medio)</span>
                            </small>
                        </div>
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
function updateSeatInfo() {
    const rows = parseInt(document.getElementById("seat_rows").value) || 10;
    const columns = parseInt(document.getElementById("seat_columns").value) || 4;
    const total = rows * columns;
    
    document.getElementById("totalSeats").textContent = total;
    
    let config = "";
    switch(columns) {
        case 3:
            config = "1-2 (pasillo a la izquierda)";
            break;
        case 4:
            config = "2-2 (pasillo en el medio)";
            break;
        case 5:
            config = "2-3 (pasillo en el medio)";
            break;
    }
    document.getElementById("seatConfig").textContent = config;
}

document.getElementById("seat_rows").addEventListener("input", updateSeatInfo);
document.getElementById("seat_columns").addEventListener("change", updateSeatInfo);

function editBus(bus) {
    document.getElementById("formTitle").textContent = "Editar Bus";
    document.getElementById("formAction").value = "update";
    document.getElementById("busId").value = bus.id;
    document.getElementById("name").value = bus.name;
    document.getElementById("seat_rows").value = bus.seat_rows;
    document.getElementById("seat_columns").value = bus.seat_columns;
    document.getElementById("submitBtn").innerHTML = "<i class=\"fas fa-save\"></i> Actualizar";
    document.getElementById("cancelBtn").style.display = "block";
    updateSeatInfo();
}

function resetForm() {
    document.getElementById("formTitle").textContent = "Nuevo Bus";
    document.getElementById("formAction").value = "create";
    document.getElementById("busId").value = "";
    document.getElementById("busForm").reset();
    document.getElementById("submitBtn").innerHTML = "<i class=\"fas fa-save\"></i> Guardar";
    document.getElementById("cancelBtn").style.display = "none";
    updateSeatInfo();
}

// Inicializar
updateSeatInfo();
</script>
';

include 'layout.php';
?> 