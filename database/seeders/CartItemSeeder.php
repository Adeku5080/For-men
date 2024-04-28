<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cart_items')->insert([
            [
              'product_id' => '6',
               'quantity' => '1',
               "cart_id" =>'1',
               "item_name" =>"cotton tshirt",
               "size"=>"Chest 32",
               "item_file_path"=>""
               
            ]
            ]);
    }
}
