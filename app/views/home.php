<!DOCTYPE html>
<html lang="en">
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
            <span class="release">PHPAML · Ready to build</span>
            <h1 data-en="Build PHP apps with clarity." data-fr="Créez des applications PHP avec clarté.">Build PHP apps with clarity.</h1>
            <p class="intro" data-en="A small, structured PHP framework with MVC, a modern CLI and everything you need to move from idea to production." data-fr="Un petit framework PHP structuré avec MVC, une CLI moderne et tout le nécessaire pour passer de l’idée à la production.">A small, structured PHP framework with MVC, a modern CLI and everything you need to move from idea to production.</p>
            <div class="actions">
                <a class="button primary" href="#start" data-en="Get started" data-fr="Commencer">Get started</a>
                <a class="button" href="https://phpaml.com/docs" data-en="Read the docs" data-fr="Lire la documentation">Read the docs</a>
            </div>
        </div>

        <div class="hero-mark">
            <div class="logo-stage">
                <img src="/img/phpaml-logo-violet-lime.png" alt="PHPAML mammoth" width="420" height="420">
            </div>
        </div>
    </section>

    <section class="proof">
        <div class="container proof-grid">
            <article><strong>MVC</strong><span data-en="Clear structure" data-fr="Structure claire">Clear structure</span></article>
            <article><strong>AML CLI</strong><span data-en="One command workflow" data-fr="Flux en une commande">One command workflow</span></article>
            <article><strong>PHP 8.2+</strong><span data-en="Modern foundation" data-fr="Base moderne">Modern foundation</span></article>
        </div>
    </section>

    <section id="start" class="start container">
        <div>
            <span class="section-label">01 — Quick start</span>
            <h2 data-en="Your project is already running." data-fr="Votre projet fonctionne déjà.">Your project is already running.</h2>
            <p data-en="Open your controller, model and view. Save your changes and the browser refreshes automatically." data-fr="Ouvrez votre contrôleur, votre modèle et votre vue. Enregistrez : le navigateur s’actualise automatiquement.">Open your controller, model and view. Save your changes and the browser refreshes automatically.</p>
        </div>
        <div class="terminal">
            <div class="terminal-title"><span></span><span></span><span></span><small>Terminal</small></div>
            <pre><code><i>$</i> aml doctor
<b>✓</b> Project ready

<i>$</i> aml serve
<em>→ http://127.0.0.1:8910</em></code></pre>
        </div>
    </section>
</main>

<?php $this->partial('footer.php') ?>
<script src="/js/main.js"></script>
</body>
</html>
