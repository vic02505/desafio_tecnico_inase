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
        width:400px; /* más ancho */
        max-width: 90%; /* para pantallas pequeñas */
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
            <button id="optionsEditBtn" style="
                background-color: #b43c96;
                border: none;
                color: white;
                padding: 10px 20px; /* un poco más grande */
                border-radius: 5px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 14px;
                font-weight: 500;
                text-align: center;
            ">
                Editar muestra
            </button>

            <button id="optionsLabBtn" style="
                background-color: #b43c96;
                border: none;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 14px;
                font-weight: 500;
                text-align: center;
            ">
                Cargar análisis de laboratorio
            </button>
        </div>
    </div>
</div>

