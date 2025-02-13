<x-app-layout>
    <div class="flex">
        <!-- Formulaire -->
        <div class="w-full md:w-1/2 bg-gray-100 p-8 mx-auto">
            <h1 class="text-4xl font-bold mb-8">Modifier votre profil</h1>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nom -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold">Nom</label>
                    <input type="text" name="name" id="name" value="{{ Auth::user()->name }}"
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-lg font-semibold">Email</label>
                    <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg" required>
                </div>

                <!-- Numéro de téléphone -->
                <div class="mb-4">
                    <label for="phone" class="block text-lg font-semibold">Numéro de téléphone</label>
                    <input type="text" name="phone" id="phone" value="{{ Auth::user()->phone }}"
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg">
                </div>

                <!-- Adresse -->
                <div class="mb-4">
                    <label for="address" class="block text-lg font-semibold">Adresse</label>
                    <input type="text" name="address" id="address" value="{{ Auth::user()->address }}"
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg">
                </div>

                <!-- Mot de passe -->
                <div class="mb-4">
                    <label for="password" class="block text-lg font-semibold">Mot de passe (optionnel)</label>
                    <input type="password" name="password" id="password"
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg">
                </div>

                <!-- Confirmer le mot de passe -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-lg font-semibold">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg">
                </div>

                <!-- Photo de profil -->
                <div class="mb-4">
                    <label for="profile_picture" class="block text-lg font-semibold">Modifier la photo de profil</label>
                    <input type="file" name="profile_picture" id="profile_picture"
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg">
                </div>

                <!-- Bouton Mettre à jour -->
                <button type="submit"
                    class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 w-full">
                    Mettre à jour
                </button>
            </form>
        </div>

        <!-- Affichage de l'image de profil actuelle -->
        <div class="hidden md:block w-full md:w-1/2 bg-gray-200 p-8">
            <div class="text-center">
                <!-- Affiche l'image actuelle, si elle existe -->
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Image de profil"
                        class="object-cover w-64 h-64 mx-auto rounded-full border-4 border-gray-300 mb-4">
                @else
                    <img src="" alt="Image de profil" class="object-cover w-64 h-64 mx-auto rounded-full border-4 border-gray-300 mb-4">
                @endif
                <p class="text-sm text-gray-600">Votre photo actuelle</p>
            </div>
        </div>
    </div>
</x-app-layout>
