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
            <?= $this->Form->hidden('_method', ['value' => 'PATCH']) ?>
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
            <p style="display: flex; justify-content: space-between; gap: 10px;">
                <button type="submit" style="
                    flex: 1;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    padding: 10px;
                    border-radius: 4px;
                    cursor: pointer;
                ">
                    Guardar Cambios
                </button>

                <button type="button" id="deleteSampleBtn" style="
                    flex: 1;
                    background-color: #d9534f;
                    color: white;
                    border: none;
                    padding: 10px;
                    border-radius: 4px;
                    cursor: pointer;
                ">
                    Eliminar Muestra
                </button>
            </p>
        </form>
    </div>
</div>
