<h1 class="page-title"><?= h($pageTitle) ?></h1>

<!-- Botón para abrir modal -->
<p>
    <button id="openModal" class="button" style="background-color: #b43c96;
        border: none;
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 500;">
        Agregar Muestra
    </button>
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














