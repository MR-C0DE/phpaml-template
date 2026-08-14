<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->partial('seo.php') ?>
    <link rel="icon" href="/img/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
<?php $this->partial('header.php') ?>

<main>
    <section class="hero container">
        <div class="hero-copy">
            <div class="status"><span></span> Application PHPAML opérationnelle</div>
            <p class="eyebrow">Votre projet commence ici</p>
            <h1>Construisez clairement.<br><em>Avancez rapidement.</em></h1>
            <p class="hero-intro">
                <strong><?= htmlspecialchars($model->getName(), ENT_QUOTES, 'UTF-8') ?></strong>
                utilise <?= htmlspecialchars($model->getDescription(), ENT_QUOTES, 'UTF-8') ?> :
                une architecture MVC lisible, une CLI moderne et toute la puissance de PHP.
            </p>
            <div class="hero-actions">
                <a class="button button-primary" href="https://phpaml.com/docs">Lire la documentation <span>→</span></a>
                <a class="button button-secondary" href="#quick-start">Explorer le projet</a>
            </div>
        </div>

        <div class="hero-visual" aria-label="Logo PHPAML">
            <div class="orbit orbit-one"></div>
            <div class="orbit orbit-two"></div>
            <div class="logo-glow"></div>
            <img src="/img/phpaml-logo-violet-lime.png" alt="Logo PHPAML" width="512" height="512">
            <span class="tech-badge badge-mvc">MVC</span>
            <span class="tech-badge badge-php">PHP 8.2+</span>
            <span class="tech-badge badge-cli">AML CLI</span>
        </div>
    </section>

    <section id="features" class="features container" aria-label="Fonctionnalités du framework">
        <article class="feature-card">
            <span class="feature-number">01</span>
            <h2>Architecture MVC</h2>
            <p>Contrôleurs, modèles et vues restent séparés dans une structure évidente et facile à faire évoluer.</p>
        </article>
        <article class="feature-card featured">
            <span class="feature-number">02</span>
            <h2>CLI intégrée</h2>
            <p>Créez, testez, diagnostiquez, construisez et déployez votre application avec la commande <code>aml</code>.</p>
        </article>
        <article class="feature-card">
            <span class="feature-number">03</span>
            <h2>Prêt à développer</h2>
            <p>Routage, injection de dépendances, validation, base de données et sécurité sont déjà en place.</p>
        </article>
    </section>

    <section id="quick-start" class="quick-start container">
        <div>
            <p class="eyebrow">Prochaine étape</p>
            <h2>Faites-en votre application.</h2>
            <p>Modifiez le contrôleur, le modèle et cette vue. Le serveur actualisera automatiquement votre navigateur.</p>
        </div>
        <div class="terminal" aria-label="Commandes de démarrage">
            <div class="terminal-bar"><i></i><i></i><i></i><span>Terminal</span></div>
            <pre><code><span class="prompt">$</span> aml doctor
<span class="success">✓</span> Project ready

<span class="prompt">$</span> aml serve
<span class="muted">→ http://localhost:8000</span></code></pre>
        </div>
    </section>
</main>
<?php $this->partial('footer.php') ?>
<script src="/js/main.js"></script>
</body>
</html>
