<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'category_name' => 'Dārzs',
            ],
            [
                'id' => 2,
                'category_name' => 'Vēsture',
            ],
            [
                'id' => 3,
                'category_name' => 'Māksla',
            ],
            [
                'id' => 4,
                'category_name' => 'Tehniskā',
            ],
            [
                'id' => 5,
                'category_name' => 'Ticība',
            ],
            [
                'id' => 6,
                'category_name' => 'Ceļojumi',
            ],
            [
                'id' => 7,
                'category_name' => 'Dadzīši',
            ],
            [
                'id' => 8,
                'category_name' => 'Fotogrāfijas',
            ],
            [
                'id' => 9,
                'category_name' => 'Citi',
            ],
            [
                'id' => 10,
                'category_name' => 'Tukša 1',
            ],
            [
                'id' => 11,
                'category_name' => 'Tukša 2',
            ],
        ]);
    }
}
