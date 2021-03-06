<?php

namespace Core\admin\models;

class Router
{
    private array $routes;

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    public function loadRoutes()
    {
        require_once(ENGINE_DIR.'/modules/twelvee/core_mod/admin/routes/routes.php');
        $this->setRoutes(routes());
    }
}