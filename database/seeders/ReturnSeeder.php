<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReturnSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil loan_detail yang sudah dikembalikan (is_return = true)
        $loanDetailIds = DB::table('loan_detail')
            ->where('is_return', true)
            ->pluck('id')
            ->toArray();

        if (empty($loanDetailIds)) {
            // Jika tidak ada, ambil semua
            $loanDetailIds = DB::table('loan_detail')->pluck('id')->toArray();
        }

        $count = min(50, count($loanDetailIds));

        $usedIds = [];
        $inserted = 0;

        while ($inserted < $count) {
            $id = $faker->randomElement($loanDetailIds);

            if (in_array($id, $usedIds)) {
                continue;
            }

            $usedIds[] = $id;
            $charge    = $faker->boolean(30); // 30% kemungkinan kena denda

            DB::table('returns')->insert([
                'loan_detail_id' => $id,
                'charge'         => $charge,
                'amount'         => $charge ? $faker->numberBetween(5000, 50000) : 0,
            ]);

            $inserted++;
        }
    }
}
