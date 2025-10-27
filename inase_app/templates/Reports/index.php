<h1 class="page-title">Reporte de Muestras</h1>

<?= $this->element('styles') ?>


<div class="filters">
    <label>Especie: <input type="text" id="filterSpecies" placeholder="Ej: Trigo"></label>
    <label>Fecha desde: <input type="date" id="filterStartDate"></label>
    <label>Fecha hasta: <input type="date" id="filterEndDate"></label>
    <div style="display: flex; gap: 10px; align-items: center;">
        <button onclick="fetchData(1)" style="
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
    ">Buscar</button>

        <button onclick="resetFilters()" style="
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
    ">Limpiar</button>
    </div>
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

<div class="pagination" style="margin-top: 25px; text-align: center; display: flex; justify-content: center; gap: 25px;">
    <button id="prevPage" onclick="changePage(-1)" style="
        background-color: #b43c96;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 500;
        text-align: center;
        margin: 0 5px;
    ">Anterior</button>

    <span id="pageInfo"></span>

    <button id="nextPage" onclick="changePage(1)" style="
        background-color: #b43c96;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 500;
        text-align: center;
        margin: 0 5px;
    ">Siguiente</button>
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
