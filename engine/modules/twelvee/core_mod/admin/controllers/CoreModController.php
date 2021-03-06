<?php

namespace Core\admin\controllers;

use Core\system\models\Request;
use Core\system\models\View;

class CoreModController extends Controller
{
    public function index(Request $request, View $view)
    {
        $view->render(
            ENGINE_DIR.'/modules/twelvee/core_mod/admin/views/main.php',
            [
                'header' => $view->getViewContent(ENGINE_DIR.'/modules/twelvee/core_mod/admin/views/header.php', []),
                'body' => $view->getViewContent(
                    ENGINE_DIR.'/modules/twelvee/core_mod/admin/views/body.php',
                    [
                        'index' => $view->getViewContent(ENGINE_DIR.'/modules/twelvee/core_mod/admin/views/store/index.php', []),
                        'settings' => $view->getViewContent(ENGINE_DIR.'/modules/twelvee/core_mod/admin/views/store/settings.php', [])
                    ]
                ),
            ]
        );
    }
}