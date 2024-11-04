<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Comment::class;
    public function definition()
{
    return [
        'comment' => $this->faker->sentence,
        'user_id' => User::factory(), // Associe le commentaire à un utilisateur
        'article_id' => Article::factory(), // Associe le commentaire à un article
        //'user_id' => User::whereHas('role', function ($query) {
           // $query->where('name', 'lecteur');
        //})->inRandomOrder()->first()->id,
        //'article_id' => Article::inRandomOrder()->first()->id,
    ];
}
    // public function definition()
    // {
    //     return [
    //         'comment' => $this->faker->sentence,
    //         'user_id' => User::whereHas('role', function ($query) {
    //             $query->where('name', 'auteur');
    //         })->inRandomOrder()->first()->id,
    //         'article_id' => Article::inRandomOrder()->first()->id,
    //     ];
    // }
}
