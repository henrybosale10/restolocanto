<x-guest-layout>
    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-semibold text-gray-900 mb-8">Détails de la Livraison</h2>
        <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-200 p-6">
            <div class="px-6 py-6 sm:px-8">
                <h3 class="text-2xl font-semibold text-gray-900">Informations de Livraison</h3>
                <p class="mt-4 text-sm text-gray-500">Consultez les détails complets de la commande et la livraison associée.</p>
            </div>
            <div class="border-t border-gray-200 px-6 py-6 sm:p-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-12">
                    <!-- Première colonne -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-6">
                            <dt class="text-sm font-medium text-gray-600 w-40"><i class="fas fa-truck text-indigo-500"></i> Commande ID</dt>
                            <dd class="text-sm text-gray-900">{{ $livraison->commande_id }}</dd>
                        </div>
                        <div class="flex items-center space-x-6">
                            <dt class="text-sm font-medium text-gray-600 w-40"><i class="fas fa-box text-indigo-500"></i> Type de Livraison</dt>
                            <dd class="text-sm text-gray-900">{{ $livraison->type }}</dd>
                        </div>
                        <div class="flex items-center space-x-6">
                            <dt class="text-sm font-medium text-gray-600 w-40"><i class="fas fa-map-marker-alt text-indigo-500"></i> Adresse de Livraison</dt>
                            <dd class="text-sm text-gray-900">{{ $livraison->adresse ?? 'Non spécifiée' }}</dd>
                        </div>
                    </div>

                    <!-- Deuxième colonne -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-6">
                            <dt class="text-sm font-medium text-gray-600 w-40"><i class="fas fa-clock text-indigo-500"></i> Heure de Livraison</dt>
                            <dd class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($livraison->heure_livraison)->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div class="flex items-center space-x-6">
                            <dt class="text-sm font-medium text-gray-600 w-40"><i class="fas fa-check-circle text-indigo-500"></i> Statut</dt>
                            <dd class="text-sm text-gray-900">{{ $livraison->statut }}</dd>
                        </div>
                        <div class="flex items-center space-x-6">
                            <dt class="text-sm font-medium text-gray-600 w-40"><i class="fas fa-money-bill-alt text-indigo-500"></i> Prix de Livraison</dt>
                            <dd class="text-sm text-gray-900">{{ $livraison->prix }} CDF</dd>
                        </div>
                        <div class="flex items-center space-x-6">
                            <dt class="text-sm font-medium text-gray-600 w-40"><i class="fas fa-calendar text-indigo-500"></i> Date de création</dt>
                            <dd class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($livraison->created_at)->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div class="flex items-center space-x-6">
                            <dt class="text-sm font-medium text-gray-600 w-40"><i class="fas fa-calendar-edit text-indigo-500"></i> Date de mise à jour</dt>
                            <dd class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($livraison->updated_at)->format('d/m/Y H:i') }}</dd>
                        </div>
                    </div>
                </div>

                <!-- Informations du livreur -->
                @if($livraison->livreur)
                <div class="mt-10 p-6 bg-gray-50 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-900">Informations sur le Livreur</h3>
                    <div class="flex items-center space-x-6 mt-4">
                        <img class="w-16 h-16 rounded-full"
                             src="{{ $livraison->livreur->photo_profil ? asset('storage/' . $livraison->livreur->photo_profil) : asset('images/default-avatar.jpg') }}"
                             alt="Photo du livreur">
                        <div class="text-sm">
                            <p class="font-medium text-gray-900">NOM : {{ $livraison->livreur->prenom }} {{ $livraison->livreur->nom }} ({{ $livraison->livreur->statut }})</p>
                            <p class="text-gray-600">Email : {{ $livraison->livreur->email }}</p>
                            <p class="text-gray-600">Téléphone: {{ $livraison->livreur->telephone }}</p>
                        </div>
                    </div>
                </div>

                @else
                <div class="mt-10 p-6 bg-gray-50 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-900">Livraison sans livreur assigné</h3>
                    <p class="text-sm text-gray-600 mt-4">Aucun livreur n'est assigné à cette livraison pour le moment.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
