<x-admin-layout>
    <h1 class="text-2xl font-semibold mb-6">Liste des Commandes</h1>

    <!-- Formulaire de filtrage -->
    <form method="GET" action="{{ route('admin.commandes.index') }}" class="mb-6 p-4 border rounded-lg shadow-sm bg-white">
        <div class="flex gap-4 mb-4">
            <div class="w-full">
                <label for="client" class="block text-sm font-medium text-gray-700">Client :</label>
                <input type="text" name="client" value="{{ request()->client }}" placeholder="Filtrer par client"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="w-full">
                <label for="status" class="block text-sm font-medium text-gray-700">Statut :</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Tous</option>
                    <option value="en_attente" {{ request()->status == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                    <option value="confirme" {{ request()->status == 'confirme' ? 'selected' : '' }}>Confirmé</option>
                    <option value="payé" {{ request()->status == 'payé' ? 'selected' : '' }}>Payé</option>
                </select>
            </div>
        </div>
        <button type="submit" class="px-6 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Filtrer</button>
    </form>

    <!-- Tableau des commandes -->
    <div class="overflow-x-auto bg-white shadow-sm rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($commandes as $commande)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $commande->client->prenom }} {{ $commande->client->nom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $commande->montant_total }} FCFA</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($commande->status) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.commandes.show', $commande->id) }}" class="text-indigo-600 hover:text-indigo-900">Voir</a>
                            @if($commande->status == 'en_attente')
                                <a href="{{ route('admin.commandes.confirmer', $commande->id) }}" class="ml-4 text-indigo-600 hover:text-indigo-900">Confirmer</a>
                                <a href="{{ route('admin.commandes.payer', $commande->id) }}" class="ml-4 text-indigo-600 hover:text-indigo-900">Payer</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
