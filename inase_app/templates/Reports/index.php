<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Muestras</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        input, select, button { padding: 5px; margin-right: 10px; }
        .filters { margin-bottom: 15px; }
        .pagination { margin-top: 10px; }
        .pagination button { padding: 5px 10px; margin-right: 5px; }
    </style>
</head>
<body>

<h1>Reporte de Muestras</h1>

<div class="filters">
    <label>Especie: <input type="text" id="filterSpecies" placeholder="Ej: Trigo"></label>
    <label>Fecha desde: <input type="date" id="filterStartDate"></label>
    <label>Fecha hasta: <input type="date" id="filterEndDate"></label>
    <button onclick="fetchData(1)">Buscar</button>
    <button onclick="resetFilters()">Limpiar</button>
</div>

<table id="samplesTable">
    <thead>
    <tr>
        <th>Código de muestra</th>
        <th>Empresa</th>
        <th>Especie</th>
        <th>Poder germinativo</th>
        <th>Pureza</th>
        <th>Materiales inertes</th>
        <th>Fecha</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

<div class="pagination">
    <button id="prevPage" onclick="changePage(-1)">Anterior</button>
    <span id="pageInfo"></span>
    <button id="nextPage" onclick="changePage(1)">Siguiente</button>
</div>

<script>
    const pageSize = 5;
    let currentPage = 1;
    let totalRecords = 0;

    async function fetchData(page = 1) {
        const species = document.getElementById('filterSpecies').value;
        const startDate = document.getElementById('filterStartDate').value;
        const endDate = document.getElementById('filterEndDate').value;

        const params = new URLSearchParams({
            species,
            start_date: startDate,
            end_date: endDate,
            page,
            limit: pageSize
        });

        try {
            const res = await fetch(`/reports/data?${params.toString()}`);
            if (!res.ok) throw new Error('Error al obtener datos');

            const json = await res.json();
            const response = json.response;
            const results = response.results || [];
            totalRecords = response.total || 0;
            currentPage = response.page || 1;

            renderTable(results);
            updatePagination();
        } catch (err) {
            console.error(err);
            alert('Error al cargar datos del reporte');
        }
    }

    function renderTable(results) {
        const tbody = document.querySelector('#samplesTable tbody');
        tbody.innerHTML = '';

        results.forEach(item => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
            <td>${item.code}</td>
            <td>${item.company}</td>
            <td>${item.species}</td>
            <td>${item.germination_power ?? ''}%</td>
            <td>${item.purity ?? ''}%</td>
            <td>${item.inert_materials ?? ''}</td>
            <td>${item.date ?? ''}</td>
        `;
            tbody.appendChild(tr);
        });
    }

    function updatePagination() {
        const totalPages = Math.ceil(totalRecords / pageSize);
        document.getElementById('prevPage').disabled = currentPage <= 1;
        document.getElementById('nextPage').disabled = currentPage >= totalPages;
        document.getElementById('pageInfo').textContent = `Página ${currentPage} de ${totalPages}`;
    }

    function changePage(delta) {
        const newPage = currentPage + delta;
        fetchData(newPage);
    }

    function resetFilters() {
        document.getElementById('filterSpecies').value = '';
        document.getElementById('filterStartDate').value = '';
        document.getElementById('filterEndDate').value = '';
        fetchData(1);
    }

    // Inicializar con la página 1
    fetchData(1);
</script>

</body>
</html>
