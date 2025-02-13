<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-900 leading-tight">
            {{ __('Réservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto px-6">
            <!-- Filtre de recherche -->
            <div class="flex justify-between mb-6 flex-wrap">
                <div class="flex space-x-4 w-full md:w-auto">
                    <!-- Formulaire de filtre -->
                    <form method="GET" action="{{ route('admin.reservations.index') }}" class="flex flex-wrap space-x-4 w-full">
                        <div class="flex flex-col mb-4 md:mb-0 w-full sm:w-48">
                            <label for="prenom" class="text-sm font-medium text-gray-700">Prénom</label>
                            <input type="text" name="prenom" value="{{ request()->prenom }}" placeholder="Prénom"
                                class="mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out w-full">
                        </div>
                        <div class="flex flex-col mb-4 md:mb-0 w-full sm:w-48">
                            <label for="nom" class="text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" name="nom" value="{{ request()->nom }}" placeholder="Nom"
                                class="mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out w-full">
                        </div>
                        <div class="flex flex-col mb-4 md:mb-0 w-full sm:w-48">
                            <label for="date_reservation" class="text-sm font-medium text-gray-700">Date de réservation</label>
                            <input type="date" name="date_reservation" value="{{ request()->date_reservation }}"
                                class="mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out w-full">
                        </div>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition-all duration-200 ease-in-out mt-4 sm:mt-0">
                            Filtrer
                        </button>
                    </form>
                </div>

                <!-- Bouton pour créer une nouvelle réservation -->
                <a href="{{ route('admin.reservations.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition duration-200 ease-in-out mt-4 sm:mt-0">
                    Nouvelle Réservation
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

            <!-- Tableau des réservations -->
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-500 to-indigo-700 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">Prénom</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nom</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Téléphone</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Date de réservation</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Table</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nombre d'invités</th>
                            <th class="px-6 py-3 text-center text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @forelse ($reservations as $reservation)
                            <tr class="hover:bg-gray-50 transition-all duration-200 ease-in-out">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $reservation->prenom }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $reservation->nom }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $reservation->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $reservation->telephone }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $reservation->date_reservation }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $reservation->table->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $reservation->number_of_guests }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="text-indigo-600 hover:text-indigo-800 transition duration-150 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                                            <path d="M21.7 4.3a1 1 0 0 0 0-1.4l-1.6-1.6a1 1 0 0 0-1.4 0L3 17.4V21h3.6L21.7 4.3zm-3.6-2.9 1.6 1.6L19 5.7 17.3 4.1l1.6-1.6zM4 19v-1.6L15.4 6 17 7.6 5.6 19H4z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.reservations.destroy', $reservation->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');" class="inline-block">
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
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Aucune réservation trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 flex justify-center">
                {{ $reservations->links() }}
            </div>
        </div>
    </div>

    <style>
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination-container a {
            display: inline-block;
            padding: 8px 12px;
            margin: 0 4px;
            text-decoration: none;
            background-color: #4F46E5;
            color: white;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .pagination-container a:hover,
        .pagination-numbers a:hover {
            background-color: #6B62FB;
        }

        .pagination-container .disabled {
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
</x-admin-layout>
