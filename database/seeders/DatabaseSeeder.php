<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();
         \App\Models\User::factory()->create(
             [
                "name" => 'admin',
                "family" => 'admin',
                "full_name" => 'admin user',
                "username" => 'admin_user',
                "email" => 'admin@test.com',
                "phone" => '0912',
                "password" => Hash::make('123456'),
                 "role" => 'admin',
             ]
         );

        \App\Models\User::factory()->create(
            [
                "name" => 'super admin',
                "family" => 'super admin',
                "full_name" => 'super admin user',
                "username" => 'super_admin_user',
                "email" => 'super_admin@test.com',
                "phone" => '0913',
                "password" => Hash::make('123456'),
                "role" => 'super_admin',
            ]
        );

        \App\Models\User::factory()->create(
            [
                "name" => 'agent',
                "family" => 'agent',
                "full_name" => 'agent user',
                "username" => 'agent_user',
                "email" => 'agent@test.com',
                "phone" => '0914',
                "password" => Hash::make('123456'),
                "role" => 'agent',
            ]
        );

        \App\Models\User::factory()->create(
            [
                "name" => 'seller',
                "family" => 'seller',
                "full_name" => 'seller user',
                "username" => 'seller_user',
                "email" => 'seller@test.com',
                "phone" => '0915',
                "password" => Hash::make('123456'),
                "role" => 'seller',
            ]
        );

        \App\Models\User::factory()->create(
            [
                "name" => 'client',
                "family" => 'client',
                "full_name" => 'client user',
                "username" => 'client_user',
                "email" => 'client@test.com',
                "phone" => '0916',
                "password" => Hash::make('123456'),
                "role" => 'client',
            ]
        );
    }
}
