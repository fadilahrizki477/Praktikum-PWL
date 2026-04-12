<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Kode jurusan yang tersedia (sesuai aturan: 55201)
        $kodejurusan = ['55201', '55202', '55203'];

        // Angkatan 21-25
        $angkatanList = ['21', '22', '23', '24', '25'];

        // Insert user dengan NPM sendiri terlebih dahulu
        DB::table('users')->insert([
            'npm'               => 5520124085,
            'username'          => 'kiki_11',
            'first_name'        => 'Fadilah',
            'last_name'         => 'Rizki',
            'email'             => 'kiki@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        $npmSet = [5520124085]; // Sudah dipakai

        $count = 1;
        $urutan = 1;

        while ($count < 50) {
            $kj       = $faker->randomElement($kodejurusan);
            $angkatan = $faker->randomElement($angkatanList);
            $uru      = str_pad($urutan, 3, '0', STR_PAD_LEFT);
            $npm      = intval($kj . $angkatan . $uru);

            if (in_array($npm, $npmSet)) {
                $urutan++;
                continue;
            }

            $npmSet[] = $npm;
            $urutan++;
            $count++;

            DB::table('users')->insert([
                'npm'               => $npm,
                'username'          => $faker->userName(),
                'first_name'        => $faker->firstName(),
                'last_name'         => $faker->lastName(),
                'email'             => $faker->unique()->safeEmail(),
                'email_verified_at' => $faker->boolean(80) ? $faker->dateTimeBetween('-1 year') : null,
                'password'          => Hash::make('password'),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}   