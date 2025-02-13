<x-admin-layout>
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tous les messages</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left px-4 py-2 border-b border-gray-200 text-sm font-semibold text-gray-600">Utilisateur</th>
                        <th class="text-left px-4 py-2 border-b border-gray-200 text-sm font-semibold text-gray-600">Message</th>
                        <th class="text-left px-4 py-2 border-b border-gray-200 text-sm font-semibold text-gray-600">Date</th>
                        <th class="text-left px-4 py-2 border-b border-gray-200 text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($messages as $message)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-700 border-b border-gray-200 text-sm">
                                {{ $message->user->name }}
                            </td>
                            <td class="px-4 py-3 text-gray-700 border-b border-gray-200 text-sm">
                                {{ Str::limit($message->message, 50) }}
                            </td>
                            <td class="px-4 py-3 text-gray-500 border-b border-gray-200 text-sm">
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-3 border-b border-gray-200 text-sm">
                                <a href="{{ route('admin.repondre.show', $message->user_id) }}"
                                   class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                                    Voir la conversation
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
