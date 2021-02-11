<?php

namespace App\Backend\Application\DataTransformers;

use App\Parser\Item\Domain\Entity\Item;

class ItemDTO
{
    /**
     * 
     * @param array $items 
     * @return array 
     */
    public static function fromPaginator(iterable $items): array
    {
        return array_map(function(array $item) {
            $data = json_decode($item['data'], true);
            $item['h1'] = $data['h1'] ?? '';
            $item['data'] = mb_substr(strip_tags($data['content'] ?? ''), 0, 200);
            return $item;
        }, $items);
    }

    public static function fromEntity(Item $item): array
    {
        $data = json_decode($item->getData(), true);
        return $data;
    }
}
