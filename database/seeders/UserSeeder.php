<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(5)->has(
            Watchlist::factory(3)->has(
                Movie::factory(5)
            )
        )->create();
    }
}
