<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(1),
            'description' => $this->faker->paragraph(),
            'published_at' => $this->faker->dateTime(),
            'is_signed_by_author' => $this->faker->boolean(),
            'is_fiction' => $this->faker->boolean(),
        ];
    }
}
