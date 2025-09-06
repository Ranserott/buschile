<?php
$title = 'Gestión de Destinos - Panel de Administración';
$pageTitle = 'Gestión de Destinos';
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
                <h6 class="m-0 font-weight-bold text-primary">Lista de Destinos</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Duración (h)</th>
                                <th>Precio (CLP)</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($destinations as $destination): ?>
                                <tr>
                                    <td><?= $destination['id'] ?></td>
                                    <td><?= htmlspecialchars($destination['origin']) ?></td>
                                    <td><?= htmlspecialchars($destination['destination']) ?></td>
                                    <td><?= $destination['duration_hours'] ?></td>
                                    <td>$<?= number_format($destination['price'], 0, ',', '.') ?> CLP</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="editDestination(<?= htmlspecialchars(json_encode($destination)) ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este destino?')">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= $destination['id'] ?>">
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
                <h6 class="m-0 font-weight-bold text-primary" id="formTitle">Nuevo Destino</h6>
            </div>
            <div class="card-body">
                <form method="POST" id="destinationForm">
                    <input type="hidden" name="action" value="create" id="formAction">
                    <input type="hidden" name="id" value="" id="destinationId">
                    
                    <div class="mb-3">
                        <label for="origin" class="form-label">Origen</label>
                        <input type="text" class="form-control" id="origin" name="origin" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="destination" class="form-label">Destino</label>
                        <input type="text" class="form-control" id="destination" name="destination" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="duration_hours" class="form-label">Duración (horas)</label>
                        <input type="number" class="form-control" id="duration_hours" name="duration_hours" min="1" max="24" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio (CLP)</label>
                        <input type="number" class="form-control" id="price" name="price" step="1" min="0" required placeholder="Ej: 3500">
                        <div class="form-text">Ingresa el precio en pesos chilenos (sin decimales)</div>
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
function editDestination(destination) {
    document.getElementById("formTitle").textContent = "Editar Destino";
    document.getElementById("formAction").value = "update";
    document.getElementById("destinationId").value = destination.id;
    document.getElementById("origin").value = destination.origin;
    document.getElementById("destination").value = destination.destination;
    document.getElementById("duration_hours").value = destination.duration_hours;
    document.getElementById("price").value = destination.price;
    document.getElementById("submitBtn").innerHTML = "<i class=\"fas fa-save\"></i> Actualizar";
    document.getElementById("cancelBtn").style.display = "block";
}

function resetForm() {
    document.getElementById("formTitle").textContent = "Nuevo Destino";
    document.getElementById("formAction").value = "create";
    document.getElementById("destinationId").value = "";
    document.getElementById("destinationForm").reset();
    document.getElementById("submitBtn").innerHTML = "<i class=\"fas fa-save\"></i> Guardar";
    document.getElementById("cancelBtn").style.display = "none";
}
</script>
';

include 'layout.php';
?> 