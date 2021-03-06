<?php

namespace Core\admin\controllers;

use Core\system\models\Request;
use Core\system\models\View;

class CoreModController extends Controller
{
    public function index(Request $request, View $view)
    {
        $items = [
            [
                'name' => 'asdasd',
            ],
            [
                'name' => 'dfgdfg',
            ]
        ];
        $view->render(
            ENGINE_DIR . '/modules/twelvee/core_mod/admin/views/main.php',
            [
                'header' => $view->getViewContent(ENGINE_DIR . '/modules/twelvee/core_mod/admin/views/header.php', []),
                'body' => $view->getViewContent(
                    ENGINE_DIR . '/modules/twelvee/core_mod/admin/views/body.php',
                    [
                        'index' => $view->getViewContent(ENGINE_DIR . '/modules/twelvee/core_mod/admin/views/store/index.php', [
                            'categories' => $view->getViewContent(ENGINE_DIR . '/modules/twelvee/core_mod/admin/views/store/categories.php', []),
                            'items' => $view->getViewContentArray(
                                ENGINE_DIR . '/modules/twelvee/core_mod/admin/views/store/item.php',
                                $items
                            ),
                        ]),
                        'settings' => $view->getViewContent(ENGINE_DIR . '/modules/twelvee/core_mod/admin/views/store/settings.php', [])
                    ]
                ),
            ]
        );
    }
}