<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Plats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto px-6">
            <div class="flex justify-between mb-6">
                <form method="GET" action="{{ route('admin.plats.index') }}" class="flex space-x-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Rechercher</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nom du plat"
                               class="block w-full sm:w-64 px-4 py-3 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700">
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow-md hover:shadow-lg transition duration-200 ease-in-out">
                        Filtrer
                    </button>
                </form>

                <a href="{{ route('admin.plats.create') }}"
                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md shadow-md hover:shadow-lg transition duration-200 ease-in-out">
                    Ajouter un Plat
                </a>
            </div>

            <!-- Tableau des plats -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nom</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Description</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Image</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($plats as $plat)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $plat->nom }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $plat->description }}</td>
                                <td class="px-6 py-4">
                                    <img src="{{ Storage::url($plat->image) }}" alt="{{ $plat->nom }}" class="w-20 h-20 object-cover rounded-md shadow-sm">
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center space-x-4">
                                        <!-- Modifier Button -->
                                        <a href="{{ route('admin.plats.edit', $plat->id) }}" class="flex items-center bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-md shadow-md hover:shadow-lg transition duration-200 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                                                <path d="M21.7 4.3a1 1 0 0 0 0-1.4l-1.6-1.6a1 1 0 0 0-1.4 0L3 17.4V21h3.6L21.7 4.3zm-3.6-2.9 1.6 1.6L19 5.7 17.3 4.1l1.6-1.6zM4 19v-1.6L15.4 6 17 7.6 5.6 19H4z"/>
                                            </svg>
                                        </a>

                                        <!-- Supprimer Button -->
                                        <form method="POST" action="{{ route('admin.plats.destroy', $plat->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce plat ?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-md hover:shadow-lg transition duration-200 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                                                    <path d="M7 4V3a3 3 0 1 1 6 0v1h5a1 1 0 1 1 0 2h-1v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6H2a1 1 0 1 1 0-2h5zm2-1v1h4V3a1 1 0 1 0-2 0 1 1 0 1 0-2 0zM6 6v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6H6z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="py-4">
                {{ $plats->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
