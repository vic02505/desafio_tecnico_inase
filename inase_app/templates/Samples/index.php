<h1><?= h($pageTitle) ?></h1>

<!-- Botón para abrir modal -->
<p>
    <button id="openModal" class="button">Agregar Muestra</button>
</p>

<!-- Tabla de muestras -->
<?= $this->element('table', ['samples' => $samples]) ?>

<!-- Modals -->
<?= $this->element('add_modal') ?>
<?= $this->element('edit_modal') ?>
<?= $this->element('lab_modal') ?>
<?= $this->element('options_modal') ?>

<!-- Scripts y estilos -->
<?= $this->element('scripts') ?>
<?= $this->element('styles') ?>














