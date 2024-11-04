<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $article->title }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <p>Par {{ $article->user->name }}</p>
        <p>{{ $article->message }}</p>

        <hr class="my-4">

        <h3 class="font-semibold text-lg">Commentaires</h3>
        @if($article->comments->isEmpty())
            <p>Aucun commentaire pour cet article.</p>
        @else
            <ul class="mb-4">
                @foreach($article->comments as $comment)
                    <li><strong>{{ $comment->user->name }} :</strong> {{ $comment->comment }}</li>
                @endforeach
            </ul>
        @endif

        <!-- Formulaire d'ajout de commentaire -->
        <form action="{{ route('comments.store', $article) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="comment" class="block text-gray-700">Ajouter un commentaire</label>
                <textarea name="comment" id="comment" rows="3" class="w-full border-gray-300 rounded-md" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Publier le commentaire</button>
        </form>

        <a href="{{ route('articles.index') }}" class="text-gray-600 mt-4 inline-block">Retour à la liste des articles</a>
    </div>
</x-app-layout>
