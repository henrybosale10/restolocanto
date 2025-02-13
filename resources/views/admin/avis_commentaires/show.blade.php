<x-admin-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-gray-900 mb-8">Détails de l'avis/commentaire</h1>

        <div class="bg-white shadow-xl rounded-lg p-6">
            <div class="space-y-4">
                <p class="text-lg font-medium text-gray-800">
                    <strong>Utilisateur :</strong> {{ $avisCommentaire->user->name }}
                </p>
                <p class="text-lg font-medium text-gray-800">
                    <strong>Contenu :</strong> <span class="text-gray-600">{{ $avisCommentaire->contenu }}</span>
                </p>
                <p class="text-lg font-medium text-gray-800">
                    <strong>Note :</strong> <span class="text-yellow-500">{{ $avisCommentaire->note }}</span>
                </p>
            </div>
        </div>

        <a href="{{ route('admin.avis_commentaires.index') }}" class="mt-6 inline-block px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all duration-300 ease-in-out">
            Retour à la liste
        </a>
    </div>
</x-admin-layout>
