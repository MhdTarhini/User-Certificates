<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
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
        // Users type
        DB::table("user_types")->insert(([
            "type"=>"admin",
        ]));
        DB::table("user_types")->insert(([
            "type"=>"user",
        ]));

        // Default Certificates Type
        DB::table("certificates")->insert(([
            "name"=>"BS",
        ]));
        DB::table("certificates")->insert(([
            "name"=>"MS",
        ]));
        DB::table("certificates")->insert(([
            "name"=>"PHD",
        ]));

        // Admin 
        DB::table("users")->insert(([
            'name'=>"admin",
            'email'=>"admin@gmail.com",
            'password'=>Hash::make('admin123'),
            'gender'=>"male",
            'blood_type'=>'O+',
            "is_approved"=>1,
            "last_login"=>null,
            "user_type_id"=>1,
        ]));

        // Default User Data 
        DB::table("users")->insert(([
            'name'=>"joe",
            'email'=>"joe@gmail.com",
            'password'=>Hash::make('1234567'),
            'gender'=>"male",
            'blood_type'=>'A+',
            "is_approved"=>0,
            "last_login"=>null,
            "user_type_id"=>2,
        ]));

        DB::table("user_certificates")->insert(([
            'user_id'=>2,
            'certificate_id'=>2,   
        ]));
        DB::table("user_certificates")->insert(([
            'user_id'=>2,
            'certificate_id'=>3,   
        ]));
        DB::table("user_certificate_details")->insert(([
            'user_certificate_id'=>1,
            'major'=>"Software Engineer",   
            'date_achieved'=> Carbon::createFromDate(2022, 12, 31),   
            'university'=>"LAU",   
        ]));
        DB::table("user_certificate_details")->insert(([
            'user_certificate_id'=>2,
            'major'=>"Civil Engineer",   
            'date_achieved'=> Carbon::createFromDate(2023, 07, 20),   
            'university'=>"AUB",   
        ]));
    }
}
