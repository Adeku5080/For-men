<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('size_charts')->insert([
            [
                'size_name' => 'waist_size',
            ],
            [
                'size_name' => 'chest_size',
            ],
            [
                'size_name' => 'shoe_size',
            ],
        ]);
    }
}
