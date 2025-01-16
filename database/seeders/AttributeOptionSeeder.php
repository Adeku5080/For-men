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
                'value' => '4',
            ],
            [
                'attribute_id' => '1',
                'value' => '6',
            ],
            [
                'attribute_id' => '1',
                'value' => '8',
            ],
            [
                'attribute_id' => '1',
                'value' => '10',
            ],
            [
                'attribute_id' => '1',
                'value' => '12',
            ],
            [
                'attribute_id' => '1',
                'value' => '14',
            ],
            [
                'attribute_id' => '1',
                'value' => '16',
            ],
            [
                'attribute_id' => '2',
                'value' => 'red',
            ],
            [
                'attribute_id' => '2',
                'value' => 'blue',
            ],
            [
                'attribute_id' => '2',
                'value' => 'yellow',
            ],
            [
                'attribute_id' => '2',
                'value' => 'green',
            ],


        ]);
    }
}
