<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         DB::table("certificates")->insert(([
            "name"=>"BS",
        ]));
        DB::table("certificates")->insert(([
            "name"=>"MS",
        ]));
        DB::table("certificates")->insert(([
            "name"=>"PHD",
        ]));

        DB::table("users")->insert(([
            'name'=>"mohamad",
            'email'=>"mohamad@gmail.com",
            'password'=>Hash::make('1234567'),
            'gender'=>"male",
            'blood_type'=>'O+',
            "is_approved"=>0,
            "last_login"=>null
        ]));
    }
}
