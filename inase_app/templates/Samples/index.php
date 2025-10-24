<h1><?= h($pageTitle) ?></h1>

<!-- Botón para abrir el modal -->
<p>
    <button id="openModal" class="button">Agregar Muestra</button>
</p>

<?php if ($samples->isEmpty()): ?>
    <p>No hay muestras registradas.</p>
<?php else: ?>
    <table class="samples-table">
        <thead>
        <tr>
            <th>Número de precinto</th>
            <th>Empresa</th>
            <th>Especie</th>
            <th>Cantidad de semillas</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($samples as $sample): ?>
            <tr data-uuid="<?= h($sample->uuid) ?>">
                <td><?= h($sample->seal_number) ?></td>
                <td><?= h($sample->company) ?></td>
                <td><?= h($sample->species) ?></td>
                <td><?= h($sample->quantity) ?></td>
                <td class="actions">
                    <!-- Editar -->
                    <button class="edit-btn" title="Editar">✏️</button>
                    <!-- Borrar -->
                    <button class="delete-btn" title="Borrar">🗑️</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- Modal oculto -->
<div id="modalForm" style="
    display:none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
">
    <div style="
        background: white;
        padding: 20px;
        border-radius: 6px;
        width: 400px;
        position: relative;
    ">
        <span id="closeModal" style="
            position: absolute;
            top: 10px; right: 10px;
            cursor: pointer;
            font-weight: bold;
        ">×</span>

        <h2>Agregar Nueva Muestra</h2>
        <form id="sampleForm" method="post" action="<?= $this->Url->build(['action' => 'add']) ?>">
            <p>
                <label>Número de Precinto:<br>
                    <input type="text" name="seal_number" required>
                </label>
            </p>
            <p>
                <label>Empresa:<br>
                    <input type="text" name="company" required>
                </label>
            </p>
            <p>
                <label>Especie:<br>
                    <input type="text" name="species" required>
                </label>
            </p>
            <p>
                <label>Cantidad de semillas:<br>
                    <input type="number" name="quantity" required>
                </label>
            </p>
            <p>
                <button type="submit">Guardar</button>
            </p>
        </form>
    </div>
</div>

<!-- JS para abrir/cerrar modal -->
<script>
    const modal = document.getElementById('modalForm');
    document.getElementById('openModal').addEventListener('click', () => {
        modal.style.display = 'flex';
    });
    document.getElementById('closeModal').addEventListener('click', () => {
        modal.style.display = 'none';
    });
</script>

<!-- Modal oculto para editar muestra -->
<div id="editModal" style="
    display:none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
">
    <div style="
        background: white;
        padding: 20px;
        border-radius: 6px;
        width: 400px;
        position: relative;
    ">
        <span id="closeEditModal" style="
            position: absolute;
            top: 10px; right: 10px;
            cursor: pointer;
            font-weight: bold;
        ">×</span>

        <h2>Editar Muestra</h2>
        <form id="editForm" method="post" action="<?= $this->Url->build(['action' => 'edit']) ?>">
            <!-- Hidden para identificar la muestra -->
            <input type="hidden" name="uuid" id="edit_id">

            <p>
                <label>Número de Precinto:<br>
                    <input type="text" name="seal_number" id="edit_seal" required>
                </label>
            </p>
            <p>
                <label>Empresa:<br>
                    <input type="text" name="company" id="edit_company" required>
                </label>
            </p>
            <p>
                <label>Especie:<br>
                    <input type="text" name="species" id="edit_species" required>
                </label>
            </p>
            <p>
                <label>Cantidad de semillas:<br>
                    <input type="number" name="quantity" id="edit_quantity" required>
                </label>
            </p>
            <p>
                <button type="submit">Guardar Cambios</button>
            </p>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editModal = document.getElementById('editModal');
        const closeEditModal = document.getElementById('closeEditModal');

        // Asociar botón de edición de cada fila
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const tr = btn.closest('tr');
                document.getElementById('edit_id').value = tr.dataset.uuid;
                document.getElementById('edit_seal').value = tr.children[0].textContent.trim();
                document.getElementById('edit_company').value = tr.children[1].textContent.trim();
                document.getElementById('edit_species').value = tr.children[2].textContent.trim();
                document.getElementById('edit_quantity').value = tr.children[3].textContent.trim();
                editModal.style.display = 'flex';
            });
        });

        closeEditModal.addEventListener('click', () => {
            editModal.style.display = 'none';
        });
    });
</script>



<!-- CSS para mejorar la tabla -->
<style>
    .samples-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        font-family: Arial, sans-serif;
    }

    .samples-table th, .samples-table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }

    .samples-table th {
        background-color: #007BFF;
        color: white;
    }

    .samples-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .samples-table tr:hover {
        background-color: #f1f1f1;
    }

    .actions button {
        background: none;
        border: none;
        cursor: pointer;
        margin-right: 5px;
        font-size: 1.1em;
    }

    .actions button:hover {
        opacity: 0.7;
    }
</style>
