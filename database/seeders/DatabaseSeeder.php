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
        DB::table("statuses")->insert([
            ["name" => "новое"],
            ["name" => "отклонено"],
            ["name" => "подтверждено"],
        ]);

        DB::table("users")->insert([
            [
                "name" => "admin",
                "middlename" => "admin",
                "surname" => "admin",
                "email" => "copp",
                "mail" => "copp",
                "tel" => "copp",
                "role" => "admin",
                "password" => Hash::make("password"),
            ],
        ]);
    }
}
