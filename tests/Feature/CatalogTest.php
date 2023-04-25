<?php

namespace Tests\Feature;

use Tests\TestCase;

class CatalogTest extends TestCase
{
    public function testCatalogCrudIsWorking()
    {
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

        /*
        $bank['b_from'] = date("Y-m-d", strtotime($bank['b_from']));
        $bank['b_to'] = date("Y-m-d", strtotime($bank['b_to']));
        $this->assertDatabaseHas('banks', $bank);

        $lastBank = Bank::latest()->first();
        $this->assertEquals($bank['b_code'], $lastBank->b_code);
        $this->assertEquals($bank['b_name'], $lastBank->b_name);
        $this->assertEquals($bank['b_account'], $lastBank->b_account);
        $this->assertEquals($bank['b_from'], date("Y-m-d", strtotime($lastBank->b_from)));
        $this->assertEquals($bank['b_to'], date("Y-m-d", strtotime($lastBank->b_to)));
        $this->assertEquals($bank['b_type'], $lastBank->b_type);
        $this->assertEquals($bank['b_show_in_props'], $lastBank->b_show_in_props);
        $this->assertEquals($bank['b_order'], $lastBank->b_order);
        */
    }
}
