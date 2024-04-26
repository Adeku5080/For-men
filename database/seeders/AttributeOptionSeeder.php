<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attribute_options')->insert([
            [
                'attribute_id' => '1',
                'value' => 'XS-Chest 32-34',
            ],
            [
                'attribute_id' => '1',
                'value' => 'S-Chest 35-37',
            ],
            [
                'attribute_id' => '1',
                'value' => 'M-Chest 38-40',
            ],
            [
                'attribute_id' => '1',
                'value' => 'L-Chest 41-43',
            ],
            [
                'attribute_id' => '1',
                'value' => 'XL-Chest 44-46',
            ],
            [
                'attribute_id' => '1',
                'value' => 'UK 6',
            ],
            [
                'attribute_id' => '1',
                'value' => 'UK 7',
            ],
            [
                'attribute_id' => '1',
                'value' => 'UK 8',
            ],
            [
                'attribute_id' => '1',
                'value' => 'UK 9',
            ],
            [
                'attribute_id' => '1',
                'value' => 'UK 10',
            ],
            [
                'attribute_id' => '1',
                'value' => 'UK 10',
            ],
            [
                'attribute_id' => '1',
                'value' => 'W27',
            ],
            [
                'attribute_id' => '1',
                'value' => 'W28',
            ],
            [
                'attribute_id' => '1',
                'value' => 'W30',
            ],
            [
                'attribute_id' => '1',
                'value' => 'W32',
            ],
            [
                'attribute_id' => '1',
                'value' => 'W33',
            ],
            [
                'attribute_id' => '1',
                'value' => 'W34',
            ],
            [
                'attribute_id' => '1',
                'value' => 'W36',
            ],
            [
                'attribute_id' => '2',
                'color' => 'red',
            ],
            [
                'attribute_id' => '2',
                'color' => 'blue',
            ],

            [
                'attribute_id' => '2',
                'color' => 'green',
            ],
            [
                'attribute_id' => '2',
                'color' => 'black',
            ],
            [
                'attribute_id' => '2',
                'color' => 'white',
            ],

        ]);

    }
}
