<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $bookshelfIds = DB::table('bookshelfs')->pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('books')->insert([
                'title'        => $faker->sentence(rand(3, 6), false),
                'author'       => $faker->name(),
                'year'         => $faker->year(),
                'publisher'    => $faker->company(),
                'city'         => $faker->city(),
                'cover'        => 'covers/default.jpg',
                'bookshelf_id' => $faker->randomElement($bookshelfIds),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
