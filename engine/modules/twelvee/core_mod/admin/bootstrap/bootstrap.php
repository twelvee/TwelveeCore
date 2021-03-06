<?php

namespace Core;

use Core\admin\models\View;

/**
 * @global $member_id
 */
function create_application(): \Core\admin\models\Request
{
    if (!defined('DATALIFEENGINE') || !defined('LOGGED_IN')) {
        die('Hacking attempt!');
    }

    $request = new \Core\admin\models\Request();

    define('CORE_DIR', ENGINE_DIR . '/modules/twelvee/core_mod');

    return $request;
}

function boot_routes(): \Core\admin\models\Router
{
    $router = new \Core\admin\models\Router();
    $router->loadRoutes();
    return $router;
}

function resolve_request(\Core\admin\models\Router $router, \Core\admin\models\Request $request)
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