<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i < 5; $i++) {
            $npm = $faker->unique()->numerify('5520######');
            DB::table('users')->insert([
                'npm'        => $npm,
                'username'   => $faker->userName(),
                'first_name' => $faker->firstName(),
                'last_name'  => $faker->lastName(),
                'email'      => $faker->unique()->safeEmail(),
                'password'   => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}