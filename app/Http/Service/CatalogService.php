<?php

namespace App\Http\Service;

use App\Models\Catalog;

class CatalogService
{
    public static function createCatalog(array $catalogData): void
    {
        $catalog = new Catalog();

        $catalog->category = $catalogData['category'];
        $catalog->name = $catalogData['name'];
        $catalog->inventory_number = $catalogData['inventory_number'];
        $catalog->language = $catalogData['language'];
        $catalog->author = $catalogData['author'];
        $catalog->year = $catalogData['year'];
        $catalog->page_count = ($catalogData['page_count'] ?? 0);
        $catalog->location = ($catalogData['location'] ?? '');

        $catalog->save();

        if (! $catalog->wasRecentlyCreated) {
            throw new Exception('Neizdevās pievienot ierakstu!');
        }
    }

    public static function updateCatalog(array $catalogData, int $catalogId): void
    {
        $catalog = Catalog::findOrFail($catalogId);

        $affectedRows = $catalog->update([
            'category' => $catalogData['category'],
            'name' => $catalogData['name'],
            'inventory_number' => $catalogData['inventory_number'],
            'language' => $catalogData['language'],
            'author' => $catalogData['author'],
            'year' => $catalogData['year'],
            'page_count' => ($catalogData['page_count'] ?? 0),
            'photo' => $catalogData['photo'],
            'location' => ($catalogData['location'] ?? ''),
        ]);

        if ($affectedRows == 0) {
            throw new \Exception('Neizdevās izlabot ierakstu!');
        }
    }
}
