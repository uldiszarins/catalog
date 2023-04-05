<?php
namespace App\Http\Service;

use App\Models\Catalog;

class CatalogService
{
    public static function createCatalog($catalogData)
    {
        $catalog = new Catalog();

        $catalog->category = $catalogData['category'];
        $catalog->name = $catalogData['name'];
        $catalog->inventory_number = $catalogData['inventory_number'];
        $catalog->language = $catalogData['language'];
        $catalog->author = $catalogData['author'];
        $catalog->year = $catalogData['year'];
        $catalog->page_count = $catalogData['page_count'];
        $catalog->photo = $catalogData['photo'];
        $catalog->location = $catalogData['location'];

        $catalog->save();

        if (!$catalog->wasRecentlyCreated) {
            throw new CustomException('Create was not successful.');
        }
    }
}