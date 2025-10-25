<!-- Modal oculto para análisis de laboratorio -->
<div id="labModal" style="
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
        width: 450px;
        position: relative;
    ">
        <span id="closeLabModal" style="
            position: absolute;
            top: 10px; right: 10px;
            cursor: pointer;
            font-weight: bold;
        ">×</span>

        <h2>Gestionar Análisis de Laboratorio</h2>

        <form id="labForm">
            <!-- Hidden para asociar análisis a la muestra -->
            <input type="hidden" name="sample_uuid" id="lab_sample_id">

            <p>
                <label>Poder germinativo (%):<br>
                    <input type="number" name="germination" id="lab_germination" min="0" max="100" required>
                </label>
            </p>
            <p>
                <label>Pureza (%):<br>
                    <input type="number" name="purity" id="lab_purity" min="0" max="100" required>
                </label>
            </p>
            <p>
                <label>Materiales inertes:<br>
                    <input type="text" name="inert_materials" id="lab_inert" placeholder="Ej: restos de paja, polvo, etc.">
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

                <button type="button" id="deleteLabBtn" style="
                    flex: 1;
                    background-color: #d9534f;
                    color: white;
                    border: none;
                    padding: 10px;
                    border-radius: 4px;
                    cursor: pointer;
                ">
                    Eliminar Análisis
                </button>
            </p>
        </form>
    </div>
</div>
