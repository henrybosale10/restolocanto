<x-guest-layout>
    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-between w-full">

            <!-- Formulaire à gauche prenant 60% de l'espace -->
            <div class="lg:w-3/5 xl:w-3/5 p-6 sm:p-12 flex flex-col">
                <div class="text-center mb-6">
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" class="w-8 mx-auto rounded-full" alt="Profile Picture" />
                </div>
                <h1 class="text-2xl xl:text-3xl font-extrabold text-center mb-8">Modifier le tttprofil</h1>
                <div class="w-full flex-1 mt-8">
                    <form method="POST" action="{{ route('profil.modifier') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name and Email on the same line -->
                        <div class="flex space-x-8 mb-4">
                            <!-- Name -->
                            <div class="w-full">
                                <label for="name" class="block font-bold text-black">Nom</label>
                                <input type="text" name="name" id="name" class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" value="{{ old('name', $user->name) }}" required />
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email -->
                            <div class="w-full">
                                <label for="email" class="block font-bold text-black">Email</label>
                                <input type="email" name="email" id="email" class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" value="{{ old('email', $user->email) }}" required />
                                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Phone and Address on the same line -->
                        <div class="flex space-x-8 mb-4 mt-5">
                            <!-- Phone -->
                            <div class="w-full">
                                <label for="phone" class="block font-bold text-black">Numéro de téléphone</label>
                                <input type="text" name="phone" id="phone" class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" value="{{ old('phone', $user->phone) }}" required />
                                @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <!-- Address -->
                            <div class="w-full">
                                <label for="address" class="block font-bold text-black">Adresse</label>
                                <input type="text" name="address" id="address" class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" value="{{ old('address', $user->address) }}" required />
                                @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Profile Picture -->
                        <div class="mx-auto mt-5">
                            <label for="profile_picture" class="block font-bold text-black">Photo de profil</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" />
                            @error('profile_picture') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                            <span class="ml-3">
                                Mettre à jour le profil
                            </span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="flex-1 bg-indigo-100 text-center hidden lg:flex">
                <div class="m-6 xl:m-8 w-1/2 bg-contain bg-center bg-no-repeat"
                     style="background-image: url('https://storage.googleapis.com/devitary-image-host.appspot.com/NEW_IMAGE_URL'); height: 180px; background-position: center;">
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
