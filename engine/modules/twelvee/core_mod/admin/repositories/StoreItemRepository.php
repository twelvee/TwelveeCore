<?php

namespace Core\admin\repositories;

class StoreItemRepository
{

    public function getAll(): array
    {
        $items = [
            [
                'name' => 'asdasd',
            ],
            [
                'name' => 'dfgdfg',
            ]
        ];
        return $items;
    }

    public function getByCategory($categoryId): array
    {
        $categoryId = (int)$categoryId;
        $items = [
            [
                'name' => $categoryId,
            ],
            [
                'name' => 'dfgdfg',
            ]
        ];
        return $items;
    }

}