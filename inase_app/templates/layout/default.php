<?php
/**
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body style="margin:0; display:flex; flex-direction:column; min-height:100vh;">

<!-- Header personalizado -->
<header style="
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f2efef;
    color: white;
    padding: 10px 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
">
    <!-- Logo / ícono -->
    <div style="display: flex; align-items: center;">
        <img src="<?= $this->Url->image('inase.png') ?>" alt="Logo"
             style="height: 55px; margin-right: 10px; object-fit: contain;">
    </div>

    <!-- Botones -->
    <div style="display: flex; gap: 10px;">
        <button onclick="window.location.href='<?= $this->Url->build('/samples') ?>'"  style="
        background-color: #b43c96;
        border: none;
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 500;
    ">
            Gestión de muestras
        </button>

        <button onclick="window.location.href='<?= $this->Url->build('/reports') ?>'" style="
        background-color: #b43c96;
        border: none;
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 500;
    ">
            Reportes
        </button>
    </div>

</header>

<!-- Contenido principal -->
<main class="main" style="flex:1;">
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</main>

<!-- Footer simple -->
<footer style="
        background-color: #2c3e50;
        color: white;
        text-align: center;
        padding: 8px;
        font-size: 14px;
    ">
    © <?= date('Y') ?> INASE — Instituto Nacional de Semillas
</footer>

</body>
</html>
