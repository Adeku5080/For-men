<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
             "name"=>"Adeku Ali",
             "email"=>"aliadeku.aam@gmail.com",
                "password"=>"adeku1997"

            ]
        ]);
    }
}
