<x-guest-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-gray-900 mb-8">Modifier l'avis ou le commentaire</h1>

        <!-- Formulaire de mise à jour -->
        <form action="{{ route('admin.avis_commentaires.update', ['avis_commentaire' => $avisCommentaire->id]) }}" method="POST" class="bg-white shadow-xl rounded-lg p-8">
            @csrf
            @method('PUT')

            <!-- Champ contenu -->
            <div class="mb-6">
                <label for="contenu" class="block text-lg font-medium text-gray-800 mb-2">Contenu</label>
                <textarea name="contenu" id="contenu" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out" rows="4" required>{{ $avisCommentaire->contenu }}</textarea>
            </div>

            <!-- Champ note -->
            <div class="mb-6">
                <label for="note" class="block text-lg font-medium text-gray-800 mb-2">Note (1 à 5)</label>
                <input type="number" name="note" id="note" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out" min="1" max="5" value="{{ $avisCommentaire->note }}" required>
            </div>

            <!-- Boutons de soumission et d'annulation -->
            <div class="flex justify-between">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold rounded-lg shadow-lg hover:bg-gradient-to-r hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-200">
                    Mettre à jour
                </button>
                <a href="{{ route('admin.avis_commentaires.index') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all duration-300 ease-in-out">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
