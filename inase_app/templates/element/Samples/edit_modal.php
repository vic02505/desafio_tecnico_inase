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
        padding: 25px;
        border-radius: 6px;
        width: 450px;
        max-width: 90%;
        position: relative;
    ">
        <span id="closeEditModal" style="
            position: absolute;
            top:10px; right:10px;
            cursor:pointer;
            font-weight:bold;
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
            <p style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 15px;">
                <button type="submit" class="btn-pink" style="flex: 1 1 200px; min-width: 120px;">
                    Guardar Cambios
                </button>
                <button type="button" id="deleteSampleBtn" class="btn-red" style="flex: 1 1 200px; min-width: 120px;">
                    Eliminar Muestra
                </button>
            </p>
        </form>
    </div>
</div>

