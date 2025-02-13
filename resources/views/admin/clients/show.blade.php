<x-admin-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col items-center py-8">
        <div class="container max-w-6xl bg-white shadow-lg rounded-lg px-8 py-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Détails du Client</h2>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                    <p class="mt-1 text-gray-600">{{ $client->name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1 text-gray-600">{{ $client->email }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <p class="mt-1 text-gray-600">{{ $client->phone }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Adresse</label>
                    <p class="mt-1 text-gray-600">{{ $client->address }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Image de Profil</label>
                    @if($client->profile_picture)
                        <img src="{{ asset('storage/' . $client->profile_picture) }}" alt="Profile Image" class="w-24 h-24 rounded-full">
                    @else
                        <span class="text-gray-600">Aucune image</span>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Rôle</label>
                    <p class="mt-1 text-gray-600">{{ ucfirst($client->role) }}</p>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.clients.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-blue-500 text-white text-sm font-bold rounded-full">
                    Retour à la liste
                </a>
            </div>

        </div>
    </div>
</x-admin-layout>
