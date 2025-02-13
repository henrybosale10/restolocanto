<x-admin-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col items-center py-8">
        <div class="container max-w-4xl bg-white shadow-lg rounded-lg px-8 py-6 space-y-6">
            <div class="flex justify-between items-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Modifier le Client</h2>
                <a href="{{ route('admin.clients.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg shadow-md hover:bg-gray-300 transition">
                   Retour à la Liste
                </a>
            </div>
            <p class="text-gray-600 mb-4">Modifiez les informations du client.</p>

            <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" id="name" name="name" value="{{ $client->name }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ $client->email }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                        <input type="text" id="phone" name="phone" value="{{ $client->phone }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                        <input type="text" id="address" name="address" value="{{ $client->address }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700">Image de Profil</label>
                        <input type="file" id="profile_picture" name="profile_picture" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Rôle</label>
                        <select id="role" name="role" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="admin" {{ $client->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $client->role == 'user' ? 'selected' : '' }}>Utilisateur</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white text-sm font-semibold rounded-lg shadow-md hover:from-blue-600 hover:to-cyan-600 transition transform hover:scale-105">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
