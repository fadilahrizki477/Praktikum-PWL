<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class BookshelfSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::table('bookshelfs')->insert([
            [
                'id'   => 1,
                'code' => 'A1',
                'name' => 'Programming'
            ]
        ]);
    }
}