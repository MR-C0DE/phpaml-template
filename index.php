<?php

// Avec le serveur PHP intégré, laisser les fichiers publics existants
// (CSS, JavaScript, images...) être servis directement.
if (PHP_SAPI === 'cli-server') {
    $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if ($requestPath === '/_aml/live-reload') {
        $watchedExtensions = ['php', 'css', 'js', 'html', 'json', 'svg'];
        $fingerprintParts = [];
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(__DIR__, FilesystemIterator::SKIP_DOTS)
        );

        foreach ($files as $file) {
            $pathname = $file->getPathname();

            if (
                $file->isFile()
                && in_array(strtolower($file->getExtension()), $watchedExtensions, true)
                && !str_contains($pathname, DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR)
                && !str_contains($pathname, DIRECTORY_SEPARATOR . '.git' . DIRECTORY_SEPARATOR)
                && !str_contains($pathname, DIRECTORY_SEPARATOR . 'aml_env' . DIRECTORY_SEPARATOR)
            ) {
                $fingerprintParts[] = $pathname . ':' . $file->getMTime() . ':' . $file->getSize();
            }
        }

        sort($fingerprintParts);
        header('Content-Type: application/json; charset=UTF-8');
        header('Cache-Control: no-store');
        echo json_encode(['version' => sha1(implode('|', $fingerprintParts))]);
        return;
    }

    $requestedFile = __DIR__ . $requestPath;

    if ($requestPath !== '/' && is_file($requestedFile)) {
        return false;
    }
}

$moduleAutoloader = __DIR__ . '/aml_env/autoload.php';
if (is_file($moduleAutoloader)) {
    require_once $moduleAutoloader;
} else {
    $frameworkAutoloader = __DIR__ . '/aml_env/framework/Autoloader.php';
    if (!is_file($frameworkAutoloader)) {
        http_response_code(500);
        exit("Environnement AML absent. Exécutez 'aml install'.");
    }
    require_once $frameworkAutoloader;
    \PHPAML\Autoloader::register([
        'PHPAML\\' => __DIR__ . '/aml_env/framework',
        'App\\' => __DIR__ . '/app',
    ]);
}

\PHPAML\Config\Env::load(__DIR__ . '/.env');

$config = require __DIR__ . '/configs/app.php';
$webApp = new \PHPAML\WebApplication($config);

$webApp->run();
