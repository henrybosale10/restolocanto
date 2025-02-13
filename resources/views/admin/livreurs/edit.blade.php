<x-admin-layout>
    <h1 class="text-3xl font-semibold mb-6">Modifier le Livreur</h1>

    <form action="{{ route('admin.livreurs.update', $livreur) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                <label for="prenom" class="block text-sm font-semibold text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $livreur->prenom) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                @error('prenom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="nom" class="block text-sm font-semibold text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $livreur->nom) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                @error('nom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $livreur->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="telephone" class="block text-sm font-semibold text-gray-700">Téléphone</label>
                <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $livreur->telephone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('telephone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="photo_profil" class="block text-sm font-semibold text-gray-700">Photo de profil</label>
                <input type="file" name="photo_profil" id="photo_profil" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('photo_profil') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="adresse" class="block text-sm font-semibold text-gray-700">Adresse</label>
                <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $livreur->adresse) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('adresse') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="statut" class="block text-sm font-semibold text-gray-700">Statut</label>
                <select name="statut" id="statut" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="disponible" {{ old('statut', $livreur->statut) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="occupé" {{ old('statut', $livreur->statut) == 'occupé' ? 'selected' : '' }}>Occupé</option>
                    <option value="en pause" {{ old('statut', $livreur->statut) == 'en pause' ? 'selected' : '' }}>En pause</option>
                </select>
                @error('statut') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="date_embauche" class="block text-sm font-semibold text-gray-700">Date d'embauche</label>
                <input type="date" name="date_embauche" id="date_embauche" value="{{ old('date_embauche', $livreur->date_embauche) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('date_embauche') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Mettre à jour
                </button>
            </div>
        </div>
    </form>
</x-admin-layout>
