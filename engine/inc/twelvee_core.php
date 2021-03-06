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

require_once(ENGINE_DIR . '/modules/twelvee/core_mod/system/bootstrap/bootstrap.php');
$request = Core\create_application();
$router = Core\boot_routes();
Core\resolve_request($router, $request);
