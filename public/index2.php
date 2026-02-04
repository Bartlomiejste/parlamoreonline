<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$appPath = __DIR__ . '/app/';

// maintenance
if (file_exists($maintenance = $appPath . 'storage/framework/maintenance.php')) {
    require $maintenance;
}

require $appPath . 'vendor/autoload.php';

$app = require_once $appPath . 'bootstrap/app.php';

/**
 * IMPORTANT:
 * Tell Laravel where the "public" directory is.
 * Because our webroot is domain root, but Laravel's public folder lives in /app/public.
 */
$app->usePublicPath($appPath . 'public');

$app->handleRequest(Request::capture());