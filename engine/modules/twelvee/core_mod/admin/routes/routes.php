<?php

use Core\admin\controllers\CoreModController;
use Core\admin\models\Route;

function routes(): array
{
    return [
        new Route('/admin.php?mod=twelvee_core', 'GET', CoreModController::class, 'index'),
    ];
}