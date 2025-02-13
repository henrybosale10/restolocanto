<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter un Plat') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-6 text-black">Ajouter un Livreur</h1>

        <form action="{{ route('admin.livreurs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Prénom -->
            <div class="mb-4">
                <label for="prenom" class="block text-sm font-semibold text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required>
                @error('prenom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Nom -->
            <div class="mb-4">
                <label for="nom" class="block text-sm font-semibold text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required>
                @error('nom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Téléphone -->
            <div class="mb-4">
                <label for="telephone" class="block text-sm font-semibold text-gray-700">Téléphone</label>
                <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                @error('telephone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Photo de profil -->
            <div class="mb-4">
                <label for="photo_profil" class="block text-sm font-semibold text-gray-700">Photo de profil</label>
                <input type="file" name="photo_profil" id="photo_profil" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                @error('photo_profil') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Adresse -->
            <div class="mb-4">
                <label for="adresse" class="block text-sm font-semibold text-gray-700">Adresse</label>
                <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                @error('adresse') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Statut -->
            <div class="mb-4">
                <label for="statut" class="block text-sm font-semibold text-gray-700">Statut</label>
                <select name="statut" id="statut" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                    <option value="disponible" {{ old('statut') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="occupé" {{ old('statut') == 'occupé' ? 'selected' : '' }}>Occupé</option>
                    <option value="en pause" {{ old('statut') == 'en pause' ? 'selected' : '' }}>En pause</option>
                </select>
                @error('statut') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Date d'embauche -->
            <div class="mb-4">
                <label for="date_embauche" class="block text-sm font-semibold text-gray-700">Date d'embauche</label>
                <input type="date" name="date_embauche" id="date_embauche" value="{{ old('date_embauche') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                @error('date_embauche') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Bouton de soumission -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>


</x-admin-layout>
