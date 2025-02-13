<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier Livraison') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.livraisons.update', $livraison->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="adresse" class="block text-gray-700">Adresse</label>
                    <input type="text" name="adresse" id="adresse" value="{{ $livraison->adresse }}" class="w-full px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white" required>
                </div>

                <div class="mb-4">
                    <label for="statut" class="block text-gray-700">Statut</label>
                    <select name="statut" id="statut" class="w-full px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white">
                        <option value="en_attente" {{ $livraison->status == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                        <option value="livrée" {{ $livraison->status == 'livrée' ? 'selected' : '' }}>Livrée</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-indigo-700 rounded-lg text-white">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
