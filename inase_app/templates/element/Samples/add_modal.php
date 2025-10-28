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
                    <input type="text" name="seal_number" minlength="10" maxlength="10" required>
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
                    <input type="number" name="quantity" min="1" required>
                </label>
            </p>
            <p style="display: flex; justify-content: center;">
                <button type="submit" class="btn-pink"> Guardar </button>
            </p>
        </form>
    </div>
</div>
