<?php

namespace Core;

use Core\system\models\Container;
use Core\system\models\Request;
use Core\system\models\Router;
use Core\system\models\View;

function create_application(): Request
{
    if (!defined('DATALIFEENGINE') || !defined('LOGGED_IN')) {
        die('Hacking attempt!');
    }

    $request = new Request();

    define('CORE_DIR', ENGINE_DIR . '/modules/twelvee/core_mod');

    return $request;
}

function boot_routes(): Router
{
    $router = new Router();
    $router->loadRoutes();
    return $router;
}

function init_di($classes): Container
{
    $container = new Container();
    foreach ($classes as $class) {
        $container->set($class);
    }
    return $container;
}

function resolve_request(Router $router, Request $request, Container $container)
{
    foreach ($router->getRoutes() as $route) {
        if ($request->getMethod() === $route->getMethod()) {
            if (compareRoutes($request->getUrl(), $route->getRoute(), $request)) {
                list($class, $action) = [$route->getClassName(), $route->getMethodName()];
                $view = new View(ENGINE_DIR . '/modules/twelvee/core_mod/admin/', 'main.php', []);
                call_user_func_array(array(new $class, $action), array_merge([$request, $view, $container], $route->getParameters()));
                $view->renderDefaultLayout();
            }
        }
    }
}

function compareRoutes(string $realUrl, string $routeUrl, Request $request)
{
    if (stristr($routeUrl, '{category}')) {
        $routeUrl = str_replace('{category}', 'category=' . $request->get('category'), $routeUrl);
    }
    return stristr($routeUrl, $realUrl);
}