<?php
/*
 * DLE-TES_mod — заготовка модуля для DLE
 *
 * @author     Talik <talik@tcse-cms.com>
 */

if (!defined('DATALIFEENGINE') || !defined('LOGGED_IN')) {
    die('Hacking attempt!');
}

spl_autoload_register(function (string $className) {
    $explodedClassName = explode('\\', $className);
    $dir = '';
    if ($explodedClassName[0] === 'Core') {
        $dir = ENGINE_DIR . '\modules\twelvee\core_mod';
    }
    $filePath = str_replace($explodedClassName[0] . '\\', '', $className);
    $filePath = $filePath . '.php';
    include($dir . '/' . $filePath);
});

/**
 * Classes for DI container storage
 */
$classes = [
    \Core\admin\repositories\StoreItemRepository::class,
    \Core\admin\services\StoreItemService::class,
];

require_once(ENGINE_DIR . '/modules/twelvee/core_mod/system/bootstrap/bootstrap.php');
$request = Core\create_application();
$router = Core\boot_routes();
$container = Core\init_di($classes);
Core\resolve_request($router, $request, $container);
