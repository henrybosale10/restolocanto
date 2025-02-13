<x-guest-layout>
    <div class="container mx-auto mt-8 px-4">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Choisir une livraison pour la commande #{{ $order->id }}</h2>

            <form action="{{ route('livraisons.store', $order->id) }}" method="POST" class="space-y-6">
                @csrf

                <!-- Type de livraison -->
                <div class="mb-6">
                    <label for="delivery_type" class="block text-lg font-medium text-gray-700">Type de livraison</label>
                    <select name="delivery_type" id="delivery_type" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition ease-in-out duration-200" required>
                        <option value="livraison">Livraison</option>
                        <option value="retrait">Retrait</option>
                    </select>
                </div>

                <!-- Adresse de livraison (seulement si type = livraison) -->
                <div id="address_field" class="mb-6">
                    <label for="address" class="block text-lg font-medium text-gray-700">Adresse de livraison</label>
                    <input type="text" name="address" id="address" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition ease-in-out duration-200" placeholder="Entrez votre adresse complète" required>
                </div>

                <!-- Sélection du livreur -->
                <div class="mb-6">
                    <label for="livreur_id" class="block text-lg font-medium text-gray-700">Choisir un livreur</label>
                    <select name="livreur_id" id="livreur_id" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition ease-in-out duration-200" required>
                        @foreach($livreurs as $livreur)
                            <option value="{{ $livreur->id }}">
                                {{ $livreur->prenom }} {{ $livreur->nom }} - {{ $livreur->statut }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sélection de l'heure de livraison -->
                <div class="mb-6">
                    <label for="heure_livraison" class="block text-lg font-medium text-gray-700">Heure de livraison (entre 9H et 22H)</label>
                    <input type="time" id="heure_livraison" name="heure_livraison" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition ease-in-out duration-200" min="09:00" max="22:00" required>
                </div>

                <!-- Affichage du prix de livraison -->
                <div class="mb-6">
                    <label class="block text-lg font-medium text-gray-700">Prix de livraison</label>
                    <input type="text" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm bg-gray-100 text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="4000 CDF" readonly>
                </div>

                <!-- Soumettre le formulaire -->
                <div class="text-center">
                    <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500 transition duration-200 ease-in-out">
                        Valider la livraison
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
