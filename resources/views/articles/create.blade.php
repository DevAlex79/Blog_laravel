<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un nouvel article') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <form action="{{ route('articles.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Titre</label>
                <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="message" class="block text-gray-700">Message</label>
                <textarea name="message" id="message" rows="5" class="w-full border-gray-300 rounded-md" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Publier l'article</button>
            <a href="{{ route('articles.index') }}" class="text-gray-600 ml-4">Annuler</a>
        </form>
    </div>
</x-app-layout>
