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
                'name' => 'onimisi mohammed',
                'email' => 'adekuonimisi561@gmail.com',
                'password' => '#Adeku1997',
            ],
        ]);
    }
}
