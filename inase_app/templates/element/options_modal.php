<div id="optionsModal" style="
    display:none;
    position: fixed;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
">
    <div style="
        background:white;
        padding:20px;
        border-radius:6px;
        width:300px;
        position:relative;
    ">
        <span id="closeOptionsModal" style="
            position:absolute;
            top:10px; right:10px;
            cursor:pointer;
            font-weight:bold;
        ">×</span>

        <h2>Opciones</h2>

        <div style="display:flex; flex-direction:column; gap:10px;">
            <button id="optionsEditBtn" style="padding:10px; border:none; border-radius:4px; background:#4CAF50; color:white; cursor:pointer;">
                Editar muestra
            </button>
            <button id="optionsLabBtn" style="padding:10px; border:none; border-radius:4px; background:#007BFF; color:white; cursor:pointer;">
                Cargar análisis de laboratorio
            </button>
        </div>
    </div>
</div>
