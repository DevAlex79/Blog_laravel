<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Http\Middleware\AuthorMiddleware;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ajout du middleware
        $this->app['router']->aliasMiddleware('author', AuthorMiddleware::class);

        // Active les contraintes de clés étrangères dans SQLite
        Schema::enableForeignKeyConstraints();

        
        // Autorisation globale pour le Super Admin
        Gate::before(function (User $user) {
            return $user->isSuperAdmin() ? true : null;
        });

        //Gate::define('comment', function (User $user) {
           // return $user->isReader();
        //});

        Gate::define('comment', function (User $user) {
            $canComment = $user->isReader();
            return $canComment;
        });

        Gate::define('delete-article', function (User $user, Article $article) {
            return $article->comments()->count() === 0;
        });

        Gate::define('edit-comment', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id;
        });
    }
}
