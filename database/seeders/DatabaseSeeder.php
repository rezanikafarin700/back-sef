<?php

namespace Database\Seeders;


use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Product::factory(30)->create();

//        $this->call([
//            UsersTableSeeder::class
//        ]);
    }
}
