<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Liste des Commandes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto px-6">
            <!-- Formulaire de filtre -->
            <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-6 flex space-x-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                    <select name="status" id="status" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tous</option>
                        <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Cancelled" {{ request('status') === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="In Progress" {{ request('status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Shipped" {{ request('status') === 'Shipped' ? 'selected' : '' }}>Shipped</option>
                    </select>
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" id="date" value="{{ request('date') }}" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex items-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Filtrer
                    </button>
                </div>
            </form>

            <!-- Résultats -->
            @if($orders->isEmpty())
                <div class="py-6 text-center bg-yellow-50 border border-yellow-300 rounded-md">
                    <p class="text-yellow-700 font-semibold">
                        Aucune commande trouvée @if(request('status')) pour le statut <strong>{{ request('status') }}</strong>@endif
                        @if(request('date')) à la date <strong>{{ request('date') }}</strong>@endif.
                    </p>
                </div>
            @else
                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Indice/commande</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Utilisateur</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Total</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Statut</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Date</th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $order->id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $order->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $order->total_price }} CDF</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-3 py-1 text-xs font-medium
                                            @if($order->status === 'Completed') text-green-800 bg-green-100
                                            @elseif($order->status === 'Pending') text-yellow-800 bg-yellow-100
                                            @elseif($order->status === 'Cancelled') text-red-800 bg-red-100
                                            @elseif($order->status === 'In Progress') text-blue-800 bg-blue-100
                                            @elseif($order->status === 'Shipped') text-blue-300 bg-blue-50
                                            @else text-gray-500 bg-gray-100 @endif
                                            rounded-full">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                                            Détails
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->

                    <div class="py-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
