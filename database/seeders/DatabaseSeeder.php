<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(10)->afterCreating(function ($user){
             $wallet = new Wallet();
             $wallet->total_amount = 0;
             $user->wallet()->save($wallet);
         })->create();
        //$this->call(AdminSeeder::class);
    }
}
