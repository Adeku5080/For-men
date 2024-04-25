<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'cotton tshirt',
                'price' => '70',
                'description' => 'Quality tshirt ,easy to wash',
                'file_path' => 'https://res.cloudinary.com/motohbaba/image/upload/v1706311490/tshirts_vest_bde6t6.jpg',
                'subcategory_id' => '4',
                'brand_id' => '4',
            ],
        ]);
    }
}
