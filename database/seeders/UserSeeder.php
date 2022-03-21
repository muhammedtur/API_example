<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::where('username', "Admin")->count() < 1) {
            $user = new User;
            $user->username = 'Admin';
            $user->name = 'Admin';
            $user->email = "info@muhammedtur.com";
            $user->password = bcrypt("epigra");
            $user->is_admin = 1;
            $user->save();            
        }
    }
}
