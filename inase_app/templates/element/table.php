<?php if ($samples->isEmpty()): ?>
    <p>No hay muestras registradas.</p>
<?php else: ?>
    <table class="samples-table">
        <thead>
        <tr>
            <th>Número de precinto</th>
            <th>Empresa</th>
            <th>Especie</th>
            <th>Cantidad de semillas</th>
            <th>Análisis</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($samples as $sample): ?>
            <tr data-uuid="<?= h($sample->uuid) ?>">
                <td><?= h($sample->seal_number) ?></td>
                <td><?= h($sample->company) ?></td>
                <td><?= h($sample->species) ?></td>
                <td><?= h($sample->quantity) ?></td>
                <td><?= !empty($sample->laboratory_analysis) ? '✅' : '❌' ?></td>
                <td class="actions">
                    <button class="options-btn" title="Opciones">⚙️</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
