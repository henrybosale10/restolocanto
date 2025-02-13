<x-admin-layout>
    <!-- En-tête du tableau -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bouton pour créer un menu -->
            <div class="flex justify-end mb-6">
                <a href="{{ route('admin.cuisine.create') }}"
                   class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 text-white rounded-md shadow-md transition duration-300 ease-in-out">
                    Ajouter un Menu
                </a>
            </div>

            <!-- Formulaire de filtre -->
            <form method="GET" action="{{ route('admin.cuisine.index') }}" class="flex items-center space-x-6 mb-8">
                <!-- Filtre par catégorie -->
                <div class="flex items-center space-x-3">
                    <label for="category" class="text-sm font-medium text-gray-700 dark:text-gray-300">Filtrer par catégorie</label>
                    <select name="category" id="category" class="block w-full sm:w-64 px-4 py-3 bg-white border-none rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700">
                        <option value="">Toutes les catégories</option>

                    </select>
                </div>

                <!-- Bouton pour appliquer le filtre -->
                <div>
                    <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 text-white rounded-md shadow-md transition duration-300 ease-in-out">
                        Filtrer
                    </button>
                </div>
            </form>

            <!-- Tableau des menus -->
            <div class="relative overflow-x-auto shadow-lg sm:rounded-lg bg-white dark:bg-gray-800 rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Type de Cuisine</th>
                            <th scope="col" class="px-6 py-3">Image</th>
                            <th scope="col" class="px-6 py-3">Description</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cuisines as $cuisine)
                            <tr class="border-b dark:border-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $cuisine->name }}</td>
                                <td class="px-6 py-4">
                                    <img src="{{ Storage::url($cuisine->image) }}" alt="{{ $cuisine->name }}" class="w-20 h-20 object-cover rounded-md shadow-sm">
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $cuisine->description }}</td>


                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.cuisine.edit', $cuisine->id) }}"
                                           class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-sm transition">
                                            Modifier
                                        </a>
                                        <form method="POST" action="{{ route('admin.cuisine.destroy', $cuisine->id) }}" onsubmit="return confirm('Voulez-vous vraiment supprimer ce menu ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-sm transition">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
