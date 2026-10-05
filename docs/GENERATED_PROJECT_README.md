# PHPAML

PHPAML est un framework MVC en PHP 8.2+ inspiré d’ASP.NET et de Java EE. Il
comprend le routage, l’injection de dépendances, les middlewares, les vues, la
validation, les sessions, la sécurité CSRF, PDO et les migrations.

## Démarrer le projet

```bash
aml serve
```

Si l’environnement `runtime/` est absent, AML le reconstruit automatiquement.
Les versions exactes des dépendances sont enregistrées dans `composer.lock`.

Commandes courantes :

```bash
aml routes
aml test
aml doctor
```

## Générateurs

```bash
aml make:controller User
aml make:model User
aml make:middleware Auth
aml make:migration create_users_table
```

## Base de données

Copiez `.env.example` vers `.env`, configurez la connexion, puis exécutez :

```bash
aml migrate
```

## Architecture

- `src/controllers` et `src/models` : logique de l’application ;
- `src/views` : vues et composants visuels ;
- `src/routes` : routes de l’application ;
- `public/` : seul dossier exposé au Web ;
- `phpaml.json` : configuration partageable ;
- `.env` : secrets et réglages propres à l’environnement ;
- `runtime/` : environnement généré, dépendances, cache et stockage local ;
- `tests/` : tests automatisés.

Ne modifiez pas manuellement `runtime/`. Le dossier doit pouvoir être
reconstruit avec `aml install`.

## Production

```bash
aml test
aml doctor --production
aml deploy <profil>
```

Configurez toujours `public/` comme racine documentaire. La racine du projet,
`.env`, `src/`, `tests/` et `runtime/` ne doivent jamais être accessibles par
HTTP.

Documentation : [phpaml.com/docs](https://phpaml.com/docs)

