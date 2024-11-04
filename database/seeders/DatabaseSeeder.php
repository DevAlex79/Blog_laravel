<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }
        public function run()
    {
        $this->call(RoleSeeder::class);

        //User::factory()->count(10)->create(); // 10 utilisateurs
        //Article::factory()->count(50)->create(); // 50 articles
        //Comment::factory()->count(1000)->create(); // 1000 commentaires

        $users = User::factory()->count(10)->create(); // Crée 10 utilisateurs
        $articles = Article::factory()->count(50)->create(); // Crée 50 articles

        // Crée 1000 commentaires avec des utilisateurs et articles existants
        foreach ($articles as $article) {
            Comment::factory()->count(20)->create([
                'article_id' => $article->id,
                'user_id' => $users->random()->id, // Associe chaque commentaire à un utilisateur aléatoire
            ]);
        }
    }
}
