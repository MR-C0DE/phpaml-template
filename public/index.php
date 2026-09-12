<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$requestPath = (string) (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');

$decodedPath = $requestPath;
for ($pass = 0; $pass < 3; $pass++) {
    $nextPath = rawurldecode($decodedPath);
    if ($nextPath === $decodedPath) { break; }
    $decodedPath = $nextPath;
}
$decodedPath = str_replace('\\', '/', $decodedPath);
if (str_contains($decodedPath, "\0") || preg_match('#(?:^|/)\.\.(?:/|$)#', $decodedPath)) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=UTF-8');
    exit('Not Found');
}

if (PHP_SAPI === 'cli-server' && $decodedPath !== '/') {
    $publicRoot = realpath(__DIR__);
    $requestedFile = realpath(__DIR__ . '/' . ltrim($decodedPath, '/'));
    if ($publicRoot !== false && $requestedFile !== false
        && str_starts_with($requestedFile, $publicRoot . DIRECTORY_SEPARATOR)
        && is_file($requestedFile)) {
        return false;
    }
}

if (PHP_SAPI === 'cli-server' && $requestPath === '/_aml/live-reload') {
    $fingerprint = [];
    foreach ([$root . '/app', $root . '/routes', $root . '/database', __DIR__] as $watchedRoot) {
        if (!is_dir($watchedRoot)) { continue; }
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($watchedRoot, FilesystemIterator::SKIP_DOTS));
        foreach ($files as $file) {
            if ($file->isFile() && in_array(strtolower($file->getExtension()), ['php', 'css', 'js', 'html', 'json', 'svg'], true)) {
                $fingerprint[] = $file->getPathname() . ':' . $file->getMTime() . ':' . $file->getSize();
            }
        }
    }
    sort($fingerprint);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode(['version' => sha1(implode('|', $fingerprint))], JSON_THROW_ON_ERROR);
    return;
}

$moduleAutoloader = $root . '/runtime/autoload.php';
if (is_file($moduleAutoloader)) {
    require_once $moduleAutoloader;
} else {
    $frameworkAutoloader = $root . '/runtime/framework/Autoloader.php';
    if (!is_file($frameworkAutoloader)) {
        http_response_code(500);
        exit('Application indisponible.');
    }
    require_once $frameworkAutoloader;
    \PHPAML\Autoloader::register(['PHPAML\\' => $root . '/runtime/framework', 'App\\' => $root . '/app']);
}

/**
 * @param array<string, mixed> $config
 * @return array<string, mixed>
 */
function phpamlComposeApplication(array $config, string $root): array
{
    $config['legacy_data_bootstrap'] = false;
    $config['bootstrappers'][] = static function (\PHPAML\Container $container, array $applicationConfig) use ($root): void {
        if (!class_exists(\AML\Data\Connections\ConnectionManager::class)) {
            return;
        }

        $dataConfig = $applicationConfig['data'] ?? null;
        if (!is_array($dataConfig)) {
            return;
        }

        $manager = new \AML\Data\Connections\ConnectionManager($root, $dataConfig);
        $container->set('AML\\Data\\Connections\\ConnectionManager', $manager);
        $container->set('AML\\Data\\Connection', $manager->sql());
    };

    return $config;
}

$config = phpamlComposeApplication(\PHPAML\Config\ApplicationConfig::load($root), $root);
(new \PHPAML\WebApplication($config))->run();
