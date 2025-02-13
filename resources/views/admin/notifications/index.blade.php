<x-admin-layout>
    <div class="container mx-auto mt-5">
        <h2 class="text-center text-2xl font-bold mb-4">Table des Notifications</h2>

        <table class="table-auto w-full bg-white shadow-md rounded-lg border-collapse border border-gray-300">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Nom de l'utilisateur</th> <!-- Nouvelle colonne pour le nom de l'utilisateur -->
                    <th class="border border-gray-300 px-4 py-2 text-left">Notifiable ID</th>

                    <th class="border border-gray-300 px-4 py-2 text-left">Type</th>

                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notifications as $notification)
                    <tr class="text-center hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $notification->user_name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $notification->notifiable_id }}</td>

                        <td class="border border-gray-300 px-4 py-2">{{ $notification->type }}</td>

                        <!-- Affichage du nom de l'utilisateur -->


                        <td class="border border-gray-300 px-4 py-2">
                            <!-- Voir -->
                            <a href="{{ route('admin.notifications.show', $notification->id) }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                                <!-- SVG pour l'icône de Voir -->
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.23 12.01C3.17 8.69 5.91 6 9 6c1.92 0 3.64 1.23 4.44 2.93.8-1.7 2.52-2.93 4.44-2.93 3.09 0 5.83 2.69 6.77 6.01-1.03 3.32-3.67 5.99-6.77 5.99-1.92 0-3.64-1.23-4.44-2.93-.8 1.7-2.52 2.93-4.44 2.93-3.09 0-5.83-2.69-6.77-6.01z"/>
                                </svg>
                                <span>Voir</span>
                            </a>

                            <!-- Supprimer -->
                            <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST" class="inline ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 flex items-center space-x-2">
                                    <!-- SVG pour l'icône de Supprimer -->
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    <span>Supprimer</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $notifications->links() }}
        </div>
    </div>
</x-admin-layout>
