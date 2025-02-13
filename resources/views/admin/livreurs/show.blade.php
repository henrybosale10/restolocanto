<x-admin-layout>
    <h1 class="text-3xl font-semibold mb-6">Détails du Livreur</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Prénom</label>
            <p class="text-gray-700">{{ $livreur->prenom }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Nom</label>
            <p class="text-gray-700">{{ $livreur->nom }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Email</label>
            <p class="text-gray-700">{{ $livreur->email }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Téléphone</label>
            <p class="text-gray-700">{{ $livreur->telephone }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Photo de profil</label>
            <img src="{{ asset('storage/' . $livreur->photo_profil) }}" alt="Photo de profil" class="w-32 h-32 rounded-full border-2 border-gray-200">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Adresse</label>
            <p class="text-gray-700">{{ $livreur->adresse }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Statut</label>
            <p class="text-gray-700">{{ ucfirst($livreur->statut) }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Date d'embauche</label>
            <p class="text-gray-700">{{ $livreur->date_embauche ? $livreur->date_embauche->format('d-m-Y') : 'Non spécifiée' }}</p>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.livreurs.edit', $livreur) }}" class="btn bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">
                Modifier
            </a>
        </div>
    </div>
</x-admin-layout>
