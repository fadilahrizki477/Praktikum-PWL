<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookshelfSeeder extends Seeder
{
    public function run(): void
    {
        $shelves = [
            ['code' => 'RAK-A', 'name' => 'Rak A - Teknologi'],
            ['code' => 'RAK-B', 'name' => 'Rak B - Sains'],
            ['code' => 'RAK-C', 'name' => 'Rak C - Ekonomi'],
            ['code' => 'RAK-D', 'name' => 'Rak D - Sosial'],
            ['code' => 'RAK-E', 'name' => 'Rak E - Referensi'],
        ];

        foreach ($shelves as $shelf) {
            DB::table('bookshelfs')->insert($shelf);
        }
    }
}
