<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nouvelle Livraison') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.livraisons.store', $commande->id) }}">
                @csrf
                <div class="mb-4">
                    <label for="commande_id" class="block text-gray-700">Commande ID</label>
                    <input type="text" name="commande_id" id="commande_id" value="{{ $commande->id }}" class="w-full px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white" readonly>
                </div>

                <div class="mb-4">
                    <label for="adresse" class="block text-gray-700">Adresse</label>
                    <input type="text" name="adresse" id="adresse" class="w-full px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-indigo-700 rounded-lg text-white">Créer</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
