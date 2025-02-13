<x-guest-layout>
    <div class="container mx-auto mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Notifications</h2>

        <!-- Notifications Table -->
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Message</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Type</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Date/Heure</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Marquer comme lu</th> <!-- Nouvelle colonne -->
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Supprimer</th> <!-- Nouvelle colonne -->
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Voir</th> <!-- Nouvelle colonne -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr class="{{ $notification->read_at ? 'text-gray-500 bg-green-100' : 'text-black font-semibold' }} hover:bg-gray-50 hover:border hover:border-gray-300 transition-all ease-in-out duration-300">

                            <td class="px-6 py-4">
                                <p class="{{ $notification->read_at ? 'text-green-600' : '' }}">
                                    @if ($notification->read_at)
                                        <span class="text-green-500">✔️✔️</span>
                                    @else
                                        <span class="text-yellow-500">🔔</span>
                                    @endif
                                    {{ $notification->data['message'] }}
                                </p>
                            </td>

                            <td class="px-6 py-4">
                                @if ($notification->type == 'App\Notifications\OrderConfirmedNotification')
                                    Commande
                                @elseif ($notification->type == 'App\Notifications\LivraisonConfirmed')
                                    Livraison
                                @elseif ($notification->type == 'App\Notifications\WelcomeNotification')
                                    Bienvenue
                                @elseif ($notification->type == 'App\Notifications\ReservationConfirmed')
                                    Reservation
                                @else
                                    Autre
                                @endif
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $notification->created_at->format('d/m/Y H:i') }}
                            </td>

                            <!-- Colonne "Marquer comme lu" -->
                            <td class="px-6 py-4 text-center">
                                @if (!$notification->read_at)
                                <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}">
                                    @csrf
                                        <button type="submit" class="text-green-500 hover:text-green-700 text-sm font-medium flex items-center space-x-1">
                                            <i class="fas fa-check-double"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500">✔️</span>
                                @endif
                            </td>

                            <!-- Colonne "Supprimer" -->
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium flex items-center space-x-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                            <!-- Colonne "Voir" -->
                            <td class="px-6 py-4 text-center">
                                <!-- Ajouter le bouton "Voir" pour afficher les détails de la commande -->
                                @if ($notification->type == 'App\Notifications\OrderConfirmedNotification')
                                    <a href="{{ route('orders.show', $notification->data['order_id']) }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium flex items-center space-x-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                                @if ($notification->type == 'App\Notifications\LivraisonConfirmed')
                                    <a href="{{ route('livraisons.details', ['livraisonId' => $notification->data['livraison_id']]) }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium flex items-center space-x-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-guest-layout>
