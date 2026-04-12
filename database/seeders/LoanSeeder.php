<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $userNpms = DB::table('users')->pluck('npm')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $loanAt   = $faker->dateTimeBetween('-6 months', 'now');
            $returnAt = $faker->dateTimeBetween($loanAt, '+1 month');

            DB::table('loans')->insert([
                'user_npm'   => $faker->randomElement($userNpms),
                'loan_at'    => $loanAt->format('Y-m-d'),
                'return_at'  => $returnAt->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
