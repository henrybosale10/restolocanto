<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Livraisons') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtre de recherche -->
            <div class="flex justify-between m-2 p-2">
                <form method="GET" action="{{ route('admin.livraisons.index') }}" class="flex space-x-4">
                    <input type="text" name="commande_id" value="{{ request()->commande_id }}" placeholder="Commande ID" class="px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white">
                    <input type="text" name="livreur" value="{{ request()->livreur }}" placeholder="Livreur" class="px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white">
                    <input type="date" name="date_livraison" value="{{ request()->date_livraison }}" class="px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white">
                    <button type="submit" class="px-4 py-2 bg-indigo-700 rounded-lg text-white">Filtrer</button>
                </form>
                <a href="{{ route('admin.livraisons.create', ['commandeId' => 1]) }}" class="px-4 py-2 bg-indigo-700 rounded-lg text-white">
                    NOUVELLE LIVRAISON
                </a>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Commande</th>
                            <th>Livreur</th>
                            <th>Statut</th>
                            <th>Date Livraison</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($livraisons as $livraison)
                            <tr>
                                <td>{{ $livraison->id }}</td>
                                <td>{{ $livraison->commande->id }}</td>
                                <td>{{ $livraison->livreur }}</td>
                                <td>
                                    <span class="px-2 py-1 text-xs rounded {{ $livraison->status == 'livrée' ? 'bg-green-500 text-white' : 'bg-gray-300 text-black' }}">
                                        {{ $livraison->status }}
                                    </span>
                                </td>
                                <td>{{ $livraison->date_livraison }}</td>
                                <td>
                                    <a href="{{ route('admin.livraisons.edit', $livraison->id) }}" class="px-4 py-2 bg-green-500 text-white">MODIFIER</a>
                                    <form method="POST" action="{{ route('admin.livraisons.destroy', $livraison->id) }}" onsubmit="return confirm('Voulez-vous vraiment supprimer cette livraison ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white">SUPPRIMER</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
