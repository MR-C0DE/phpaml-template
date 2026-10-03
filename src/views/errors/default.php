<?php

declare(strict_types=1);

/** @var int $status */
/** @var string $title */
/** @var string $message */
/** @var string|null $requestId */
/** @var Throwable|null $error */
/** @var bool $debug */

$escape = static fn (string $value): string => htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex,nofollow">
  <title><?= $status ?> - <?= $escape($title) ?></title>
  <link rel="stylesheet" href="/css/error.css">
</head>
<body>
  <main class="error-page">
    <p class="error-page__brand">PHPAML</p>
    <p class="error-page__status"><?= $status ?></p>
    <h1><?= $escape($title) ?></h1>
    <p class="error-page__message"><?= $escape($message) ?></p>

    <?php if ($requestId !== null): ?>
      <p class="error-page__reference">Reference: <code><?= $escape($requestId) ?></code></p>
    <?php endif; ?>

    <a class="error-page__link" href="/">Return home</a>

    <?php if ($debug && $error !== null): ?>
      <details class="error-page__debug" open>
        <summary>Development details</summary>
        <p><strong><?= $escape($error::class) ?></strong>: <?= $escape($error->getMessage()) ?></p>
        <p><?= $escape($error->getFile()) ?>:<?= $error->getLine() ?></p>
        <pre><?= $escape($error->getTraceAsString()) ?></pre>
      </details>
    <?php endif; ?>
  </main>
</body>
</html>
