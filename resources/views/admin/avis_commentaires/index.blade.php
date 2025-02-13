<x-admin-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-gray-900 mb-8">Gestion des avis et commentaires</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-600 text-white rounded-lg shadow-xl">
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <a href="{{ route('admin.avis_commentaires.create') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-700 text-white rounded-lg shadow-lg hover:bg-gradient-to-r hover:from-indigo-600 hover:to-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-200 transition-all duration-300 ease-in-out mb-6">
            Ajouter un avis/commentaire
        </a>

        <div class="overflow-x-auto bg-white shadow-2xl rounded-lg">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-gradient-to-r from-indigo-700 to-indigo-500 text-white">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold">#</th>
                        <th class="px-6 py-4 text-sm font-semibold">Utilisateur</th>
                        <th class="px-6 py-4 text-sm font-semibold">Contenu</th>
                        <th class="px-6 py-4 text-sm font-semibold">Note</th>
                        <th class="px-6 py-4 text-sm font-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($avisCommentaires as $avis)
                        <tr class="border-b hover:bg-gray-100 transition-all duration-200 ease-in-out">
                            <td class="px-6 py-4 text-gray-800">{{ $avis->id }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $avis->user->name }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ Str::limit($avis->contenu, 50) }}</td>
                            <td class="px-6 py-4 text-gray-800">
                                <!-- Affichage des étoiles pour la note -->
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $avis->note >= $i ? '-fill' : '' }} text-yellow-400"></i>
                                @endfor
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-4">
                                    <a href="{{ route('admin.avis_commentaires.edit', $avis->id) }}" class="text-indigo-600 hover:text-indigo-800 transition duration-300 ease-in-out text-sm px-4 py-2 rounded-lg border border-indigo-600 hover:bg-indigo-100">
                                        <i class="bi bi-pencil-square"></i> Modifier
                                    </a>
                                    <form action="{{ route('admin.avis_commentaires.destroy', $avis->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-300 ease-in-out text-sm px-4 py-2 rounded-lg border border-red-600 hover:bg-red-100" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?')">
                                            <i class="bi bi-trash"></i> Supprimer
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
</x-admin-layout>
