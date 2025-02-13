<x-app-layout>
    <div class="container mx-auto py-6">
        <h2 class="text-2xl font-bold mb-4">Mes commandes</h2>

        <div class="bg-white shadow rounded-lg p-6">
            <table class="table-auto w-full">
                <thead>
                    <tr class="text-left">
                        <th class="px-4 py-2">ID de la commande</th>
                        <th class="px-4 py-2">Statut</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="px-4 py-2">{{ $order->id }}</td>
                            <td class="px-4 py-2">{{ ucfirst($order->status) }}</td>
                            <td class="px-4 py-2">{{ number_format($order->total_price, 2) }} €</td>
                            <td class="px-4 py-2">{{ $order->placed_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-800">Voir les détails</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
