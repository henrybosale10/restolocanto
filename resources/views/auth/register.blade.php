cvvvvvvvvvvvvvv
<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf

    <!-- Nom et Email -->
    <div class="flex space-x-8 mb-4">
        <div class="w-full">
            <label for="name" class="block font-bold text-black">Nom</label>
            <input type="text" name="name" id="name" class="w-full px-8 py-4 rounded-lg bg-gray-100 border placeholder-gray-500 text-sm focus:outline-none" value="{{ old('name') }}" required />
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="w-full">
            <label for="email" class="block font-bold text-black">Email</label>
            <input type="email" name="email" id="email" class="w-full px-8 py-4 rounded-lg bg-gray-100 border placeholder-gray-500 text-sm focus:outline-none" value="{{ old('email') }}" required />
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Numéro de téléphone et Adresse -->
    <div class="flex space-x-8 mb-4">
        <div class="w-full">
            <label for="phone" class="block font-bold text-black">Numéro de téléphone</label>
            <input type="text" name="phone" id="phone" class="w-full px-8 py-4 rounded-lg bg-gray-100 border placeholder-gray-500 text-sm focus:outline-none" value="{{ old('phone') }}" required />
            @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="w-full">
            <label for="address" class="block font-bold text-black">Adresse</label>
            <input type="text" name="address" id="address" class="w-full px-8 py-4 rounded-lg bg-gray-100 border placeholder-gray-500 text-sm focus:outline-none" value="{{ old('address') }}" required />
            @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Mot de passe -->
    <div class="flex space-x-8 mb-4">
        <div class="w-full">
            <label for="password" class="block font-bold text-black">Mot de passe</label>
            <input type="password" name="password" id="password" class="w-full px-8 py-4 rounded-lg bg-gray-100 border placeholder-gray-500 text-sm focus:outline-none" required />
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="w-full">
            <label for="password_confirmation" class="block font-bold text-black">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-8 py-4 rounded-lg bg-gray-100 border placeholder-gray-500 text-sm focus:outline-none" required />
        </div>
    </div>

    <!-- Photo de profil -->
    <div class="mt-5">
        <label for="profile_picture" class="block font-bold text-black">Photo de profil</label>
        <input type="file" name="profile_picture" id="profile_picture" class="w-full px-8 py-4 rounded-lg bg-gray-100 border text-sm focus:outline-none" />
        @error('profile_picture') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <!-- Bouton d'envoi -->
    <button type="submit" class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300">
        Créer un compte
    </button>
</form>
