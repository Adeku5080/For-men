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
            'product_id' =>'3',
            'chest_size' => 'XS-chest 36',
           ],
            [
            'product_id' => '3',
            "chest_size" => "S-chest 38",
           ],
            [
            "product_id" => "3",
            "chest_size" => "M-chest 40",
           ],
            [
            "product_id" => "3",
            "chest_size" => "L-chest 42",
           ],
              [
            "product_id" => "3",
            "chest_size" => "XL-chest 44",
           ],


        ]);
    }
}
