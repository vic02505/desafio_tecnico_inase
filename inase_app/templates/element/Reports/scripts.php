<script>
    const pageSize = 4;
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
            <td>${item.uuid}</td>
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

    fetchData(1);
</script>
