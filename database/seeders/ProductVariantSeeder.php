<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_variants')->insert([
            [
                'product_id' => '6',
                'quantity' => '4',
                'sku' => 'cot-shi-che-32-red',
            ],
        ]);
    }
}
