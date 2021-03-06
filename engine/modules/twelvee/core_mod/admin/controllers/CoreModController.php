<?php

namespace Core\admin\controllers;

use Core\admin\repositories\StoreItemRepository;
use Core\system\models\Container;
use Core\system\models\Request;
use Core\system\models\View;

class CoreModController extends Controller
{
    public function index(Request $request, View $view, Container $container)
    {
        /** @var StoreItemRepository $repository */
        $repository = $container->get(StoreItemRepository::class);
        $items = $repository->getAll();
        $this->renderIndexPage($view, $items);
    }

    public function indexWithCategory(Request $request, View $view, Container $container)
    {
        /** @var StoreItemRepository $repository */
        $repository = $container->get(StoreItemRepository::class);
        $items = $repository->getByCategory($request->get('category'));
        $this->renderIndexPage($view, $items);
    }

    private function renderIndexPage(View $view, array $items)
    {
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