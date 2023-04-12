<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            [
                'id' => 1,
                'language' => 'Latviešu',
            ],
            [
                'id' => 2,
                'language' => 'Angļu',
            ],
            [
                'id' => 3,
                'language' => 'Krievu',
            ],
            [
                'id' => 4,
                'language' => 'Vācu',
            ],
        ]);
    }
}
