<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;
    public function definition()
{
    return [
        'title' => $this->faker->sentence,
        'message' => $this->faker->paragraph,
        'user_id' => User::whereHas('role', function ($query) {
            $query->where('name', 'auteur');
        })->inRandomOrder()->first()->id,
    ];
}
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
}
