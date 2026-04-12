<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Teknologi Informasi',
            'Pemrograman',
            'Basis Data',
            'Jaringan Komputer',
            'Kecerdasan Buatan',
            'Matematika',
            'Fisika',
            'Kimia',
            'Biologi',
            'Ekonomi',
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->insert(['category' => $cat]);
        }
    }
}
