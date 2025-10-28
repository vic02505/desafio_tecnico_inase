<?= $this->Html->css('tables') ?>
<?= $this->Html->css('buttons') ?>
<?= $this->Html->css('actions') ?>
<?= $this->Html->css('margins') ?>

<h1 class="page-title"><?= h($pageTitle) ?></h1>

<!-- Botón para abrir modal -->
<p>
    <button id="openModal" class="btn-pink">
        Agregar Muestra
    </button>
</p>

<!-- Tabla de muestras -->
<?= $this->element('Samples/table', ['samples' => $samples]) ?>

<!-- Modals -->
<?= $this->element('Samples/add_modal') ?>
<?= $this->element('Samples/edit_modal') ?>
<?= $this->element('Samples/lab_modal') ?>
<?= $this->element('Samples/options_modal') ?>

<!-- Scripts  -->
<?= $this->element('Samples/scripts') ?>














