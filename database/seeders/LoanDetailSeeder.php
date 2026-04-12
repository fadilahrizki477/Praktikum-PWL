<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LoanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $loanIds = DB::table('loans')->pluck('id')->toArray();
        $bookIds = DB::table('books')->pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('loan_detail')->insert([
                'loan_id'    => $faker->randomElement($loanIds),
                'book_id'    => $faker->randomElement($bookIds),
                'is_return'  => $faker->boolean(50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
