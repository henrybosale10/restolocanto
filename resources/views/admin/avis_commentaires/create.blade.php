<x-admin-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-gray-900 mb-8">Ajouter un avis ou un commentaire</h1>

        <form action="{{ route('admin.avis_commentaires.store') }}" method="POST" class="bg-white shadow-xl rounded-lg p-8">
            @csrf

            <div class="mb-6">
                <label for="contenu" class="block text-lg font-medium text-gray-800 mb-2">Contenu</label>
                <textarea name="contenu" id="contenu" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out" rows="4" required></textarea>
            </div>

            <div class="mb-6">
                <label for="note" class="block text-lg font-medium text-gray-800 mb-2">Note (1 à 5)</label>
                <input type="number" name="note" id="note" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out" min="1" max="5">
            </div>

            <div class="flex justify-between">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold rounded-lg shadow-lg hover:bg-gradient-to-r hover:from-green-600 hover:to-green-800 focus:outline-none focus:ring-4 focus:ring-green-200 transition-all duration-300 ease-in-out">
                    Ajouter
                </button>
                <a href="{{ route('admin.avis_commentaires.index') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all duration-300 ease-in-out">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
