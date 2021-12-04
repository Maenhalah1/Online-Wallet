<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = "admin admin";
        $admin->username = "admin";
        $admin->email = "admin@admin.com";
        $admin->password = "admin";
        $admin->save();


    }
}
