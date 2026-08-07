<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use PHPAML\Config\Env;
use PHPAML\Middleware\SecurityHeadersMiddleware;

return [
    'name' => 'PHPAML',
    'debug' => Env::bool('APP_DEBUG', true),
    'views_path' => dirname(__DIR__) . '/app/views',
    'database' => [
        'dsn' => Env::get('DATABASE_DSN', 'sqlite:' . dirname(__DIR__) . '/aml_env/storage/database.sqlite'),
        'username' => Env::get('DATABASE_USER'),
        'password' => Env::get('DATABASE_PASSWORD'),
    ],
    'routes' => [
        'GET /' => [
            'handler' => [HomeController::class, 'index'],
            'name' => 'home',
        ],
    ],
    'middlewares' => [SecurityHeadersMiddleware::class],
];
