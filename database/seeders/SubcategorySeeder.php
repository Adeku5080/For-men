<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert([
            [
                'name' => 'T-shirt & vest',
                'category_id' => '12',
                'file_path' => 'https://res.cloudinary.com/motohbaba/image/upload/v1706311490/tshirts_vest_bde6t6.jpg',
            ],
            [
                'name' => 'Jeans',
                'category_id' => '12',
                'file_path' => 'https://res.cloudinary.com/motohbaba/image/upload/v1706311490/tshirts_vest_bde6t6.jpg',
            ],
            [
                'name' => 'Trainers',
                'category_id' => '13',
                'file_path' => 'https://res.cloudinary.com/motohbaba/image/upload/v1706311490/tshirts_vest_bde6t6.jpg',
            ],
            [
                'name' => 'Boots',
                'category_id' => '13',
                'file_path' => 'https://res.cloudinary.com/motohbaba/image/upload/v1706311490/tshirts_vest_bde6t6.jpg',
            ],
            [
                'name' => 'Sunglasses',
                'category_id' => '14',
                'file_path' => 'https://res.cloudinary.com/motohbaba/image/upload/v1706311490/tshirts_vest_bde6t6.jpg',
            ],
            [
                'name' => 'Caps & Hats',
                'category_id' => '14',
                'file_path' => 'https://res.cloudinary.com/motohbaba/image/upload/v1706311490/tshirts_vest_bde6t6.jpg',
            ],
            [
                'name' => 'Phones',
                'category_id' => '15',
                'file_path' => 'https://res.cloudinary.com/motohbaba/image/upload/v1706311490/tshirts_vest_bde6t6.jpg',
            ],
            [
                'name' => 'Laptop',
                'category_id' => '15',
                'file_path' => 'https://res.cloudinary.com/motohbaba/image/upload/v1706311490/tshirts_vest_bde6t6.jpg',
            ],
        ]);
    }
}
