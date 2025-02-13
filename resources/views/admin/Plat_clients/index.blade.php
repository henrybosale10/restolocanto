<x-admin-layout>
    <!-- En-tête du tableau -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Plats Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bouton pour ajouter un plat client -->
            <div class="flex justify-end mb-6">
                <a href="{{ route('admin.platclients.create') }}"
                   class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 text-white rounded-md shadow-md transition duration-300 ease-in-out">
                    Ajouter un Plat Client
                </a>
            </div>

            <!-- Formulaire de filtre avec barre de recherche -->
            <form method="GET" action="{{ route('admin.platclients.index') }}" class="flex items-center space-x-6 mb-8">
                <input type="text" name="search" value="{{ request()->search }}" placeholder="Rechercher un plat..." class="px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Rechercher</button>
            </form>

            <!-- Tableau des plats clients -->
            <div class="relative overflow-x-auto shadow-lg sm:rounded-lg bg-white dark:bg-gray-800 rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nom</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Prix</th>
                            <th scope="col" class="px-6 py-3">Image</th>
                            <th scope="col" class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($platClients as $platClient)
                            <tr class="border-b dark:border-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $platClient->nom }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $platClient->description }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $platClient->prix }} CDF</td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    @if ($platClient->image)
                                        <img src="{{ asset('storage/'.$platClient->image) }}" alt="{{ $platClient->nom }}" class="w-16 h-16 object-cover rounded-md">
                                    @else
                                        <span class="text-gray-500">Pas d'image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.platclients.edit', $platClient->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                                            <path d="M21.7 4.3a1 1 0 0 0 0-1.4l-1.6-1.6a1 1 0 0 0-1.4 0L3 17.4V21h3.6L21.7 4.3zm-3.6-2.9 1.6 1.6L19 5.7 17.3 4.1l1.6-1.6zM4 19v-1.6L15.4 6 17 7.6 5.6 19H4z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.platclients.destroy', $platClient->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce plat ?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                                                <path d="M7 4V3a3 3 0 1 1 6 0v1h5a1 1 0 1 1 0 2h-1v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6H2a1 1 0 1 1 0-2h5zm2-1v1h4V3a1 1 0 1 0-2 0 1 1 0 1 0-2 0zM6 6v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6H6z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="py-4">
                {{ $platClients->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
