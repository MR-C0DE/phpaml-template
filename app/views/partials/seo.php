<?php

declare(strict_types=1);

$manifestFile = dirname(__DIR__, 3) . '/phpaml.json';
$manifest = is_file($manifestFile) ? json_decode((string) file_get_contents($manifestFile), true) : [];
$seo = is_array($manifest) && is_array($manifest['seo'] ?? null) ? $manifest['seo'] : [];
$escape = static fn (mixed $value): string => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
$baseUrl = rtrim((string) ($seo['base_url'] ?? ''), '/');
$path = (string) (parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/');
$canonical = $baseUrl . ($path === '/' ? '/' : '/' . ltrim($path, '/'));
$image = (string) ($seo['image'] ?? '');
$imageUrl = str_starts_with($image, 'http') ? $image : $baseUrl . '/' . ltrim($image, '/');
$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => (string) ($seo['type'] ?? 'WebSite'),
    'name' => (string) ($seo['site_name'] ?? ''),
    'url' => $canonical,
    'description' => (string) ($seo['description'] ?? ''),
];
?>
<title><?= $escape($seo['title'] ?? $seo['site_name'] ?? '') ?></title>
<meta name="description" content="<?= $escape($seo['description'] ?? '') ?>">
<meta name="robots" content="<?= $escape($seo['robots'] ?? 'index,follow') ?>">
<?php if (($seo['author'] ?? '') !== ''): ?><meta name="author" content="<?= $escape($seo['author']) ?>"><?php endif ?>
<?php if (($seo['theme_color'] ?? '') !== ''): ?><meta name="theme-color" content="<?= $escape($seo['theme_color']) ?>"><?php endif ?>
<link rel="canonical" href="<?= $escape($canonical) ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= $escape($seo['site_name'] ?? '') ?>">
<meta property="og:title" content="<?= $escape($seo['title'] ?? '') ?>">
<meta property="og:description" content="<?= $escape($seo['description'] ?? '') ?>">
<meta property="og:url" content="<?= $escape($canonical) ?>">
<meta property="og:locale" content="<?= $escape($seo['locale'] ?? 'en_CA') ?>">
<?php if ($image !== ''): ?><meta property="og:image" content="<?= $escape($imageUrl) ?>"><?php endif ?>
<meta name="twitter:card" content="<?= $escape($seo['twitter_card'] ?? 'summary_large_image') ?>">
<meta name="twitter:title" content="<?= $escape($seo['title'] ?? '') ?>">
<meta name="twitter:description" content="<?= $escape($seo['description'] ?? '') ?>">
<?php if ($image !== ''): ?><meta name="twitter:image" content="<?= $escape($imageUrl) ?>"><?php endif ?>
<script type="application/ld+json"><?= json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
