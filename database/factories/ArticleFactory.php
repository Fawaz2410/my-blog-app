<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Gunakan fake() untuk generate data acak
            'title' => fake()->sentence(), // Membuat kalimat acak untuk judul
            'content' => fake()->paragraphs(3, true), // Membuat 3 paragraf
            'published_at' => fake()->date(), // Membuat tanggal acak
            'user_id' => \App\Models\User::factory(), // Default jika user_id tidak diisi manual
        ];
    }
}