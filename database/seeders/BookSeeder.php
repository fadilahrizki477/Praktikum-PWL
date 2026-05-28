<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title'        => 'Pemrograman Laravel',
                'author'       => 'Lalan Jaelani, S.T,.M.T',
                'year'         => 2026,
                'publisher'    => 'Informatika Press',
                'city'         => 'Cianjur',
                'bookshelf_id' => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]
        ]);
    }
}