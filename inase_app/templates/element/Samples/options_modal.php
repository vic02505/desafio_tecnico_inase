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
        padding:25px;
        border-radius:6px;
        width:400px;
        max-width: 90%;
        position:relative;
    ">
        <span id="closeOptionsModal" style="
            position:absolute;
            top:10px; right:10px;
            cursor:pointer;
            font-weight:bold;
        ">×</span>

        <h2>Opciones</h2>

        <div style="display:flex; flex-direction:column; gap:12px; margin-top:15px;">
            <button id="optionsEditBtn" class="btn-pink"> Editar muestra </button>
            <button id="optionsLabBtn" class="btn-pink"> Cargar análisis de laboratorio </button>
        </div>

    </div>
</div>

