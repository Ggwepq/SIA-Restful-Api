<?php

namespace Database\Factories;

use App\Models\Watchlist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'watchlist_id' => Watchlist::factory(),
            'tmdb_id' => $this->faker->numberBetween(100000, 999999),
            'added_at' => now(),
        ];
    }
}
