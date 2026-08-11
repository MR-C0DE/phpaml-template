<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="/css/index.css">
    <title><?= htmlspecialchars($model->getName(), ENT_QUOTES, 'UTF-8') ?></title>
</head>
<body>
<?php $this->partial('header.php') ?>

<main class="container">
    <section class="hero">
        <p class="eyebrow">Micro-framework PHP</p>
        <h1>Bienvenue dans <?= htmlspecialchars($model->getName(), ENT_QUOTES, 'UTF-8') ?></h1>
        <p>
            <?= htmlspecialchars($model->getDescription(), ENT_QUOTES, 'UTF-8') ?>.
            Cette application minimale teste le routage, le contrôleur, le modèle
            et le passage de données vers la vue.
        </p>
    </section>

    <section class="features" aria-label="Fonctionnalités du framework">
        <article>
            <h2>Routage</h2>
            <p>Association de routes HTTP à des contrôleurs PHP.</p>
        </article>
        <article>
            <h2>Vues</h2>
            <p>Rendu de modèles PHP avec données et vues partielles.</p>
        </article>
        <article>
            <h2>MVC</h2>
            <p>Séparation simple entre modèles, contrôleurs et présentation.</p>
        </article>
    </section>
</main>
<?php $this->partial('footer.php') ?>
<script src="/js/main.js"></script>
</body>
</html>
