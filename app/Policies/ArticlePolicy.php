<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{
    //public function delete(User $user, Article $article)
    public function delete(Article $article)
    {
        return $article->comments()->count() === 0;
    }
}
