<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">Détails de la commande #{{ $order->id }}</h1>

        <!-- Afficher les erreurs de validation -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Afficher les messages de succès -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informations sur la commande -->
            <div class="bg-white shadow-md rounded-lg border overflow-hidden">
                <div class="px-6 py-4 bg-indigo-100 border-b">
                    <h3 class="text-lg font-semibold text-indigo-800">Informations sur la commande</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="divide-y divide-gray-200">
                        <div class="py-4 flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Utilisateur :</dt>
                            <dd class="text-sm text-gray-900 font-semibold">{{ $order->user->name }}</dd>
                        </div>
                        <div class="py-4 flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Total :</dt>
                            <dd class="text-sm text-gray-900 font-semibold">{{ $order->total_price }} €</dd>
                        </div>
                        <div class="py-4 flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Statut :</dt>
                            <dd class="text-sm text-gray-900 font-semibold">

                            </dd>
                        </div>
                        <div class="py-4 flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Date :</dt>
                            <dd class="text-sm text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Articles de la commande -->
            <div class="bg-white shadow-md rounded-lg border overflow-hidden">
                <div class="px-6 py-4 bg-indigo-100 border-b">
                    <h3 class="text-lg font-semibold text-indigo-800">Articles</h3>
                </div>
                <div class="px-6 py-4">
                    <ul class="divide-y divide-gray-200">
                        @foreach ($order->orderItems as $item)
                            <li class="py-4">
                                <p class="text-gray-800 font-semibold">Plat : {{ $item->nom }}</p>
                                <p class="text-gray-600">Quantité : {{ $item->quantity }}</p>
                                <p class="text-gray-600">Prix unitaire : {{ $item->price }} €</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Changer le statut -->
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mt-6">
            @csrf
            <div class="bg-white shadow-md rounded-lg border overflow-hidden px-6 py-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Changer le statut :</label>
                <div class="flex items-center space-x-4">
                    <select id="status" name="status" class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>En cours de traitement</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Complétée</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                    </select>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2">
                        Mettre à jour
                    </button>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>
