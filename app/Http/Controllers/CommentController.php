<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
        /**
     * Enregistre un nouveau commentaire pour un article spécifique.
     */
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

         // Vérifie si Auth::id() est nul
           // dd(Auth::id()); OU
           //dd(Auth::check(), Auth::id()); // Cela affichera si l'utilisateur est connecté et son ID


            // Vérifie que l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('articles.show', $article)->with('error', 'Vous devez être connecté pour commenter.');
        }

        Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(), // Associe le commentaire à l'utilisateur connecté
            'article_id' => $article->id,
        ]);

        return redirect()->route('articles.show', $article)->with('success', 'Commentaire ajouté avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment->update([
            'comment' => $request->comment,
        ]);

        return redirect()->route('articles.show', $comment->article)->with('success', 'Commentaire mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('articles.show', $comment->article)->with('success', 'Commentaire supprimé avec succès.');
    }
}
