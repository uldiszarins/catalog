<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\Catalog;

class CatalogTest extends TestCase
{
    public function testCatalogCrudIsWorking()
    {
        $this->withoutMiddleware();

        $catalog = [
            'category' => rand(1, 11),
            'name' => 'Test name',
            'inventory_number' => 1001,
            'language' => 1,
            'author' => 'Autors',
            'page_count' => rand(1, 2000),
            'location' => 'location',
            'year' => rand(1990, 2023),
        ];

        $response = $this->post('/catalog', $catalog);

        $response->assertStatus(302);
        $response->assertRedirect('/catalog/create');

        $this->assertDatabaseHas('catalogs', $catalog);

        $lastCatalog = Catalog::latest()->first();
        $this->assertEquals($catalog['category'], $lastCatalog->category);
        $this->assertEquals($catalog['name'], $lastCatalog->name);
        $this->assertEquals($catalog['inventory_number'], $lastCatalog->inventory_number);
        $this->assertEquals($catalog['language'], $lastCatalog->language);
        $this->assertEquals($catalog['author'], $lastCatalog->author);
        $this->assertEquals($catalog['page_count'], $lastCatalog->page_count);
        $this->assertEquals($catalog['location'], $lastCatalog->location);
        $this->assertEquals($catalog['year'], $lastCatalog->year);
    }

    public function testCatalogUpdateValues()
    {
        $this->withoutMiddleware();

        $catalogData = [
            'category' => rand(1, 11),
            'name' => 'asddfgsdfg',
            'inventory_number' => 3001,
            'language' => 2,
            'author' => 'asfdfgds',
            'page_count' => rand(1, 2000),
            'location' => 'ghfdfghdfgh',
            'year' => rand(1990, 2023),
            'file' => UploadedFile::fake()->image('test_image.jpg'),
        ];

        $response = $this->put('/catalog/4', $catalogData)
            ->assertRedirect('/');

        $updatedCatalog = Catalog::find(4);
        $this->assertEquals($catalogData['category'], $updatedCatalog->category);
        $this->assertEquals($catalogData['name'], $updatedCatalog->name);
        $this->assertEquals($catalogData['inventory_number'], $updatedCatalog->inventory_number);
        $this->assertEquals($catalogData['language'], $updatedCatalog->language);
        $this->assertEquals($catalogData['author'], $updatedCatalog->author);
        $this->assertEquals($catalogData['page_count'], $updatedCatalog->page_count);
        $this->assertEquals($catalogData['location'], $updatedCatalog->location);
        $this->assertEquals($catalogData['year'], $updatedCatalog->year);
    }
}
