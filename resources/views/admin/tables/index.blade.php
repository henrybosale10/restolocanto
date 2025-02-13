<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Liste des tables
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto px-6">
            <!-- Filtre des tables -->
            <div class="flex justify-between mb-6">
                <div class="flex space-x-4">
                    <!-- Formulaire de filtre -->
                    <form method="GET" action="{{ route('admin.tables.index') }}" class="flex space-x-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                            <select name="status" id="status" class="mt-1 block w-40 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 ease-in-out">
                                <option value="">Tous</option>
                                <option value="disponible" @selected(request('status') == 'disponible')>Disponible</option>
                                <option value="indisponible" @selected(request('status') == 'indisponible')>Occupée</option>
                                <option value="reservee" @selected(request('status') == 'reservee')>Réservée</option>
                            </select>
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Emplacement</label>
                            <input type="text" name="location" id="location" value="{{ request('location') }}" class="mt-1 block w-40 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 ease-in-out" placeholder="Emplacement...">
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow-md hover:shadow-lg transition duration-200 ease-in-out">
                            Filtrer
                        </button>
                    </form>
                </div>

                <!-- Bouton pour créer une nouvelle table -->
                <a href="{{ route('admin.tables.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md shadow-md hover:shadow-lg transition duration-200 ease-in-out">
                    Nouvelle Table
                </a>
            </div>

            <!-- Alerte d'erreur -->
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-lg" role="alert">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-red-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6M12 6v12" />
                        </svg>
                        <p class="font-bold">Erreur</p>
                    </div>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Tableau des tables -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg mb-16">
                <table class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nom</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nombre d'invités</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Statut</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Emplacement</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($tables as $table)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $table->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $table->guest_number }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($table->status === \App\Enums\StatutTable::Disponible)
                                        <span class="px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Disponible</span>
                                    @elseif ($table->status === \App\Enums\StatutTable::Indisponible)
                                        <span class="px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Occupée</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Réservée</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $table->location }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.tables.edit', $table->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                                            <path d="M21.7 4.3a1 1 0 0 0 0-1.4l-1.6-1.6a1 1 0 0 0-1.4 0L3 17.4V21h3.6L21.7 4.3zm-3.6-2.9 1.6 1.6L19 5.7 17.3 4.1l1.6-1.6zM4 19v-1.6L15.4 6 17 7.6 5.6 19H4z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.tables.destroy', $table->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette table ?');" class="inline-block">
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
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Aucune table trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-container flex justify-center items-center space-x-4">
                <a href="{{ $tables->previousPageUrl() }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-md shadow-md disabled:opacity-50 {{ $tables->onFirstPage() ? 'disabled' : '' }}">
                    Précédent
                </a>

                <span class="text-sm text-gray-700">
                    Page {{ $tables->currentPage() }} sur {{ $tables->lastPage() }}
                </span>

                <a href="{{ $tables->nextPageUrl() }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-md shadow-md disabled:opacity-50 {{ $tables->hasMorePages() ? '' : 'disabled' }}">
                    Suivant
                </a>
            </div>

            <!-- Liste des pages (boutons numériques) -->
            <div class="pagination-numbers mt-4 flex justify-center space-x-2">
                @for ($i = 1; $i <= $tables->lastPage(); $i++)
                    <a href="{{ $tables->url($i) }}" class="px-4 py-2 text-sm font-medium {{ $i == $tables->currentPage() ? 'bg-blue-600 text-white' : 'bg-white text-blue-600' }} border border-gray-300 rounded hover:bg-blue-100 transition duration-150 ease-in-out">
                        {{ $i }}
                    </a>
                @endfor
            </div>
        </div>
    </div>

    <style>
        .pagination-container,
        .pagination-numbers {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 10;
            background-color: white;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        .pagination-container a,
        .pagination-numbers a {
            display: inline-block;
            text-align: center;
        }
    </style>
</x-admin-layout>
