
<div class="search-filters">
    <label>Especie:
        <input type="text" id="filterSpecies" placeholder="Ej: Trigo">
    </label>
    <label>Fecha desde:
        <input type="date" id="filterStartDate">
    </label>
    <label>Fecha hasta:
        <input type="date" id="filterEndDate">
    </label>
    <div class="buttons">
        <button onclick="fetchData(1)" class="btn-pink">Buscar</button>
        <button onclick="resetFilters()" class="btn-pink">Limpiar</button>
    </div>
</div>
