<x-app-layout>
    <div class="bg-gradient-to-r from-gray-200 to-gray-100 min-h-screen flex items-center justify-center p-6">
        <div class="bg-white rounded-6xl shadow-xl max-w-9xl w-full p-10 transition-all duration-300">
            <!-- Section Image de profil et détails utilisateurs -->
            <div class="flex flex-col md:flex-row space-y-8 md:space-y-0 md:space-x-10">
                <!-- Carte d'image de profil -->
                <div class="md:w-1/3 text-center mb-8 md:mb-0">
                    <div class="max-w-sm rounded-lg overflow-hidden shadow-lg relative">
                        <!-- Image et Fond -->
                        <img class="w-full h-72 object-cover rounded-lg" src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://images.pexels.com/photos/3779t448/pexels-photo-3779448.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500' }}" alt="Image">

                        <!-- Fond avec superposition -->
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-blue-700 to-transparent p-6 text-white flex flex-col justify-end items-center rounded-lg">
                            <p class="text-2xl font-bold">{{ Auth::user()->name }}</p>
                        </div>

                        <!-- Bouton flottant en bas à droite -->
                        <div class="absolute bottom-0 right-0 mb-6 mr-6 rounded-full h-16 w-16 flex items-center bg-green-500 justify-center text-4xl font-bold text-white shadow-xl transform hover:scale-105 transition-all">
                            VOIR
                        </div>
                    </div>
                </div>

                <!-- Section des détails utilisateurs (décalée vers la droite) -->
                <div class="md:w-2/3 text-center md:text-left space-y-8 ml-auto">
                    <!-- À propos de moi -->
                    <div class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-700">À propos de moi</h2>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            {{ Auth::user()->about_me ?? 'Aucune description disponible.' }}
                        </p>
                    </div>

                    <!-- Informations de Contact -->
                    <div class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-700">Informations de contact</h2>
                        <ul class="space-y-4 text-gray-600">
                            <li><strong>Email :</strong> {{ Auth::user()->email ?? 'Email non renseigné' }}</li>
                            <li><strong>Téléphone :</strong> {{ Auth::user()->phone ?? 'Numéro non renseigné' }}</li>
                            <li><strong>Adresse :</strong> {{ Auth::user()->address ?? 'Adresse non renseignée' }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Boutons de navigation avec espacement et transitions -->
            <div class="flex justify-center space-x-8 mt-8">
                <a href="{{ route('historique.commandes') }}" class="bg-blue-600 text-white py-3 px-6 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                    Historique des commandes
                </a>
                <a href="{{ route('profile.edit') }}" class="bg-green-600 text-white py-3 px-6 rounded-full shadow-lg hover:bg-green-700 transition-all duration-300 transform hover:scale-105">
                    Modifier
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white py-3 px-6 rounded-full shadow-lg hover:bg-red-600 transition-all duration-300 transform hover:scale-105">
                        Se Déconnecter
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .space-y-8 {
            margin-bottom: 32px;
        }

        .leading-relaxed {
            line-height: 1.75;
        }
    </style>
</x-app-layout>
