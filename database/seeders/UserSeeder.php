<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "Super Admin",
                "phone" => "+2348107215634",
                "email" => "superadmin@admin.com",
                "gender" => "male",
                "password" => bcrypt("password")
            ],
            [
                "name" => "Admin",
                "phone" => "+2348107215634",
                "email" => "admin@admin.com",
                "gender" => "male",
                "password" => bcrypt("password")
            ],
            [
                "name" => "Estate Managers",
                "phone" => "+2348107215634",
                "email" => "manager@admin.com",
                "gender" => "male",
                "password" => bcrypt("password")
            ],
            [
                "name" => "Security Company",
                "phone" => "+2348107215634",
                "email" => "securitycompany@admin.com",
                "gender" => "male",
                "password" => bcrypt("password")
            ],
            [
                "name" => "Security Guards",
                "phone" => "+2348107215634",
                "email" => "securityguard@admin.com",
                "gender" => "male",
                "password" => bcrypt("password")
            ],
            [
                "name" => "Residents",
                "phone" => "+2348107215634",
                "email" => "resident@admin.com",
                "gender" => "male",
                "password" => bcrypt("password")
            ],
        ];
        User::insert($data);
    }
}
