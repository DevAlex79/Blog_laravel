<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des articles') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <a href="{{ route('articles.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Créer un nouvel article</a>

        @if($articles->isEmpty())
            <p>Aucun article disponible.</p>
        @else
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Titre</th>
                        <th class="py-2 px-4 border-b">Auteur</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $article->title }}</td>
                            <td class="py-2 px-4 border-b">{{ $article->user->name }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('articles.show', $article) }}" class="text-blue-500">Voir</a>
                                <a href="{{ route('articles.edit', $article) }}" class="text-yellow-500 ml-2">Modifier</a>
                                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 ml-2">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
