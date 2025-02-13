<x-admin-layout>
    <div class="min-h-screen bg-light py-16">
        <div class="container bg-white shadow-lg rounded-lg p-4">
            <h2 class="text-4xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Liste des Utilisateurs</h2>
            <p class="text-muted mb-6">Gérez vos utilisateurs en toute simplicité.</p>

            <!-- Bouton Créer un utilisateur -->
            <div class="mb-4">
                <a href="{{ route('admin.clients.create') }}" class="inline-block px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-md transition duration-300 ease-in-out">
                    Créer un utilisateur
                </a>
            </div>

            <!-- Barre de recherche -->
            <div class="flex mb-4">
                <form action="{{ route('admin.clients.index') }}" method="GET" class="flex w-full">
                    <input type="text" name="search" class="form-control w-full sm:w-2/3 px-4 py-3 bg-white border rounded-md focus:ring-2 focus:ring-indigo-500" placeholder="Rechercher un utilisateur..." value="{{ request()->search }}">
                    <button type="submit" class="px-6 py-3 ml-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 text-white rounded-md shadow-md transition duration-300 ease-in-out">
                        Rechercher
                    </button>
                </form>
            </div>

            <!-- Tableau des utilisateurs -->
            <div class="overflow-x-auto shadow-lg sm:rounded-lg bg-white dark:bg-gray-800 rounded-lg">
                <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nom</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Téléphone</th>
                            <th scope="col" class="px-6 py-3">Adresse</th>
                            <th scope="col" class="px-6 py-3">Profil</th>
                            <th scope="col" class="px-6 py-3">Rôle</th>
                            <th scope="col" class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr class="border-b dark:border-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $client->name }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $client->email }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $client->phone }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $client->address }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    @if($client->profile_picture)
                                        <img src="{{ asset('storage/' . $client->profile_picture) }}" alt="Profile Image" class="w-16 h-16 object-cover rounded-md">
                                    @else
                                        <span class="text-gray-500">Aucune image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    <span class="badge bg-{{ $client->role === 'admin' ? 'success' : 'primary' }}">{{ ucfirst($client->role) }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.clients.edit', $client->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.clients.destroy', $client->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">
                                            <i class="bi bi-trash"></i>
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
                {{ $clients->links() }}
            </div>

            <!-- Liste des pages (boutons numériques) -->
            <div class="mt-4 flex justify-center space-x-2">
                @for ($i = 1; $i <= $clients->lastPage(); $i++)
                    <a href="{{ $clients->url($i) }}" class="px-4 py-2 text-sm font-medium {{ $i == $clients->currentPage() ? 'bg-indigo-600 text-white' : 'bg-white text-indigo-600' }} border border-gray-300 rounded hover:bg-indigo-100 transition duration-150 ease-in-out">
                        {{ $i }}
                    </a>
                @endfor
            </div>
        </div>
    </div>
</x-admin-layout>
