<?php
/**
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html lang="sp">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <style>
        /* --- Layout general --- */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
            overflow-x: hidden;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- HEADER --- */
        header {
            width: 100vw; /* fuerza a ocupar todo el ancho visible */
            position: relative;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f2efef;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            flex-wrap: wrap;
            box-sizing: border-box;
        }

        header img {
            height: 55px;
            margin-right: 10px;
            object-fit: contain;
        }

        .header-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .header-buttons button {
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
            transition: background-color 0.2s;
        }

        .header-buttons button:hover {
            background-color: #9a337f;
        }

        /* --- CONTENIDO PRINCIPAL --- */
        main {
            flex: 1;
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
            box-sizing: border-box;
        }

        /* --- FOOTER --- */
        footer {
            width: 100vw; /* asegura ancho completo visible */
            position: relative;
            left: 0;
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            box-sizing: border-box;
        }

        /* --- Responsividad --- */
        @media (max-width: 700px) {
            header {
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 15px;
            }

            header img {
                margin: 0 0 10px 0;
            }

            .header-buttons {
                justify-content: center;
                width: 100%;
            }

            .header-buttons button {
                width: 100%;
                max-width: 250px;
            }

            footer {
                font-size: 13px;
                padding: 12px;
            }
        }

    </style>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
<!-- Header -->
<header>
    <div style="display: flex; align-items: center;">
        <img src="<?= $this->Url->image('inase.png') ?>" alt="Logo">
    </div>

    <div class="header-buttons">
        <button onclick="window.location.href='<?= $this->Url->build('/samples') ?>'">
            Gestión de muestras
        </button>
        <button onclick="window.location.href='<?= $this->Url->build('/reports') ?>'">
            Reportes
        </button>
    </div>
</header>

<!-- Contenido principal -->
<main>
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</main>

<!-- Footer -->
<footer>
    © <?= date('Y') ?> INASE — Instituto Nacional de Semillas
</footer>
</body>
</html>
