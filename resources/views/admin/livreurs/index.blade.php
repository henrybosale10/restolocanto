<x-admin-layout>
    <h1 class="text-3xl font-semibold mb-6 text-gray-800">Liste des Livreurs</h1>

    <!-- Formulaire de filtrage -->
    <form method="GET" action="{{ route('admin.livreurs.index') }}" class="mb-6 bg-gray-100 p-4 rounded-lg shadow">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Filtrer par nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ request('nom') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Filtrer par statut -->
            <div>
                <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                <select name="statut" id="statut"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Tous</option>
                    <option value="disponible" {{ request('statut') === 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="occupe" {{ request('statut') === 'occupe' ? 'selected' : '' }}>Occupé</option>
                    <option value="pause" {{ request('statut') === 'pause' ? 'selected' : '' }}>En Pause</option>
                </select>
            </div>

            <!-- Filtrer par date d'embauche -->
            <div>
                <label for="date_embauche" class="block text-sm font-medium text-gray-700">Date d'embauche</label>
                <input type="date" name="date_embauche" id="date_embauche" value="{{ request('date_embauche') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition-all">
                Rechercher
            </button>
            <a href="{{ route('admin.livreurs.index') }}"
               class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700 transition-all">
                Réinitialiser
            </a>
        </div>
    </form>

    <!-- Bouton pour ajouter un livreur -->
    <a href="{{ route('admin.livreurs.create') }}"
       class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition-all duration-200 ease-in-out mb-4 inline-block">
        Ajouter un livreur
    </a>

    <!-- Tableau des livreurs -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">Photo</th>
                    <th class="px-4 py-3 text-left">Nom</th>
                    <th class="px-4 py-3 text-left">Prénom</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Téléphone</th>
                    <th class="px-4 py-3 text-left">Adresse</th>
                    <th class="px-4 py-3 text-left">Statut</th>
                    <th class="px-4 py-3 text-left">Date d'embauche</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($livreurs as $livreur)
                    <tr>
                        <!-- Photo -->
                        <td class="px-4 py-3">
                            @if($livreur->photo_profil)
                                <img src="{{ asset('storage/' . $livreur->photo_profil) }}" alt="Photo de {{ $livreur->prenom }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <span class="w-12 h-12 rounded-circle bg-gray-300 d-flex align-items-center justify-content-center text-white">?</span>
                            @endif
                        </td>

                        <!-- Nom et autres informations -->
                        <td class="px-4 py-3 text-gray-800">{{ $livreur->nom }}</td>
                        <td class="px-4 py-3 text-gray-800">{{ $livreur->prenom }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $livreur->email }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $livreur->telephone }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $livreur->adresse }}</td>

                        <!-- Statut avec badge -->
                        <td class="px-4 py-3 text-sm">
                            @if ($livreur->statut === 'disponible')
                                <span class="px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Disponible</span>
                            @elseif ($livreur->statut === 'occupe')
                                <span class="px-3 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Occupé</span>
                            @elseif ($livreur->statut === 'pause')
                                <span class="px-3 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">En Pause</span>
                            @else
                                <span class="px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Inactif</span>
                            @endif
                        </td>

                        <!-- Date d'embauche -->
                        <td>
                            {{ $livreur->date_embauche ? \Carbon\Carbon::parse($livreur->date_embauche)->format('d/m/Y') : \Carbon\Carbon::now()->format('d/m/Y') }}
                        </td>

                        <!-- Actions -->
                        <td class="px-4 py-3 text-center">
                            <!-- Bouton d'édition -->
                            <a href="{{ route('admin.livreurs.edit', $livreur->id) }}"
                               class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                                    <path d="M21.7 4.3a1 1 0 0 0 0-1.4l-1.6-1.6a1 1 0 0 0-1.4 0L3 17.4V21h3.6L21.7 4.3zm-3.6-2.9 1.6 1.6L19 5.7 17.3 4.1l1.6-1.6zM4 19v-1.6L15.4 6 17 7.6 5.6 19H4z"/>
                                </svg>
                            </a>

                            <!-- Bouton de suppression -->
                            <form method="POST" action="{{ route('admin.livreurs.destroy', $livreur->id) }}"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce livreur ?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                                        <path d="M7 4V3a3 3 0 1 1 6 0v1h5a1 1 0 1 1 0 2h-1v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6H2a1 1 0 1 1 0-2h5zm2-1v1h4V3a1 1 0 1 0-2 0 1 1 0 1 0-2 0zM6 6v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6H6z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-3 text-center text-gray-500">
                            Aucun livreur trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $livreurs->links() }}
    </div>
</x-admin-layout>
