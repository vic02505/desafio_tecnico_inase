<?php if ($samples->isEmpty()): ?>
    <p>No hay muestras registradas.</p>
<?php else: ?>
    <div class="table-container">
        <table class="data-table">
            <thead>
            <tr>
                <th>Número de precinto</th>
                <th>Empresa</th>
                <th>Especie</th>
                <th>Cantidad de semillas</th>
                <th>Análisis de laboratorio cargado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($samples as $sample): ?>
                <tr data-uuid="<?= h($sample->uuid) ?>" data-has-lab="<?= !empty($sample->has_lab_analysis) ? '1' : '0' ?>">
                    <td><?= h($sample->seal_number) ?></td>
                    <td><?= h($sample->company) ?></td>
                    <td><?= h($sample->species) ?></td>
                    <td><?= h($sample->quantity) ?></td>
                    <td class="analysis"><?= !empty($sample->has_lab_analysis) ? '✅' : '❌' ?></td>
                    <td class="actions">
                        <button class="actions; options-btn" title="Opciones">⚙️</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
