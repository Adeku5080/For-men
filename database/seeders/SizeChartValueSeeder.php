<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeChartValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('size_chart_values')->insert([
            [
                'size_value' => 'XXS-W-27',
            ],
            [
                'size_value' => 'XS-W-28',
            ],

            [
                'size_value' => 'S-W-30',
            ],
            [
                'size_value' => 'M-W-32',
            ],
            [
                'size_value' => 'L-W-34',
            ],
            [
                'size_value' => '2XS chest 34',
            ],
            [
                'size_value' => 'XS chest 36',
            ],
            [
                'size_value' => 'S chest 38',
            ],
            [
                'size_value' => 'M chest 40',
            ],
            [
                'size_value' => 'L chest 42',
            ],
            [
                'size_value' => 'Uk 5',
            ],
            [
                'size_value' => 'Uk 6',
            ],
            [
                'size_value' => 'Uk 6',
            ],
            [
                'size_value' => 'Uk 7',
            ],
            [
                'size_value' => 'Uk 8',
            ],
            [
                'size_value' => 'Uk 9',
            ],

        ]);
    }
}
