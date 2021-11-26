<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Admin;
use App\Organizer;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
        User::create([
            'name' => "user".rand(10,100),
            'email' =>  "user".rand(10,100)."@gmail.com",
            'password' => Hash::make('password'),
        ]);

        Admin::create([
            'name' => "admin".rand(10,100),
            'email' =>  "admin".rand(10,100)."@gmail.com",
            'password' => Hash::make('password'),
        ]);

        Organizer::create([
            'name' => "organizer".rand(10,100),
            'email' => "organizer".rand(10,100)."@gmail.com",
            'password' => Hash::make('password'),
        ]);

    }
}
