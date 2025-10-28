<?= $this->Html->css('tables') ?>
<?= $this->Html->css('buttons') ?>
<?= $this->Html->css('margins') ?>
<?= $this->Html->css('search_filters') ?>

<h1 class="page-title">Reporte de Muestras</h1>

<!-- Filtros de busqueda -->
<?= $this->element('Reports/filters') ?>

<!-- Tabla de reportes -->
<?= $this->element('Reports/table') ?>

<!-- Control de paginacion -->
<?= $this->element('Reports/pagination_control') ?>

<!-- Scripts js -->
<?= $this->element('Reports/scripts') ?>
