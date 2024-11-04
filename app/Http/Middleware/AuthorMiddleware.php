<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();
          // Vérifie si l'utilisateur est connecté et s'il est soit auteur soit admin
        //if (!Auth::check() || !(Auth::user()->isAuthor() || Auth::user()->isAdmin())) {
            if (!$user || !($user->isAuthor() || $user->isAdmin())) {
            // Redirection vers le dernier article du blog
            return redirect()->route('articles.show', ['article' => $this->getLastArticleId()]);
        }

        // L'utilisateur est authentifié et a le rôle d'auteur
        return $next($request);
    }

    /**
     * Récupère l'ID du dernier article publié.
     * @return int|null
     */
    protected function getLastArticleId()
    {
        return \App\Models\Article::latest()->first()->id ?? null; // Retourne l'ID du dernier article ou null
    }
}
