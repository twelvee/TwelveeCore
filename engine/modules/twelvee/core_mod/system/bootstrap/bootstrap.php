<?php

namespace Core;

use Core\system\models\View;

/**
 * @global $member_id
 */
function create_application(): \Core\system\models\Request
{
    if (!defined('DATALIFEENGINE') || !defined('LOGGED_IN')) {
        die('Hacking attempt!');
    }

    $request = new \Core\system\models\Request();

    define('CORE_DIR', ENGINE_DIR . '/modules/twelvee/core_mod');

    return $request;
}

function boot_routes(): \Core\system\models\Router
{
    $router = new \Core\system\models\Router();
    $router->loadRoutes();
    return $router;
}

function resolve_request(\Core\system\models\Router $router, \Core\system\models\Request $request)
{
    foreach ($router->getRoutes() as $route) {
        if($request->getMethod() === $route->getMethod()) {
            if($request->getUrl() === $route->getRoute()) {
                list($class, $action) = [$route->getClassName(), $route->getMethodName()];
                $view = new View(ENGINE_DIR.'/modules/twelvee/core_mod/admin/', 'main.php', []);
                call_user_func_array(array(new $class, $action), array_merge($route->getParameters(), [$request, $view]));
                $view->renderDefaultLayout();
            }
        }
    }
}