<style>
    .samples-table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .samples-table th, .samples-table td {
        border-bottom: 1px solid #ddd;
        padding: 12px 15px;
    }

    .samples-table th {
        background-color: #b43c96;
        color: white;
        font-weight: 600;
        text-align: left;
    }

    .samples-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .samples-table tr:hover {
        background-color: #e6f0ff;
    }

    /* ✅ columna de análisis centrada */
    .samples-table td:nth-child(5) {
        text-align: center;
        font-size: 18px;
    }

    /* ⚙️ columna de acciones centrada */
    .samples-table td.actions {
        text-align: center;
    }

    /* botón del engranaje */
    .options-btn {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        padding: 6px 8px;
        border-radius: 6px;
        transition: background 0.2s, transform 0.1s;
    }

    .options-btn:hover {
        background-color: rgba(0, 123, 255, 0.1);
        transform: scale(1.1);
    }


    .actions button { background: none; border: none; cursor: pointer; margin-right: 5px; font-size: 1.1em; }
    .actions button:hover { opacity: 0.7; }
    .page-title {margin-top: 30px}
</style>
