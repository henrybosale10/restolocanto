<x-guest-layout>
    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
        <div class="max-w-screen-xl w-full sm:m-10 bg-white shadow-lg sm:rounded-xl flex justify-between">

            <!-- Left form section -->
            <div class="lg:w-11/12 xl:w-11/12 p-6 sm:p-12 flex flex-col">
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/henofood.png') }}" alt="HenoFood" class="w-20 h-20 rounded-full border-2 border-gray-200">
                </div>

                <h1 class="text-3xl font-extrabold text-center mb-8">Créer un compte</h1>
                <form method="POST" action="{{ route('inscription') }}" enctype="multipart/form-data" id="registerForm">
                    @csrf

                    <!-- Name and Email fields -->
                    <div class="flex space-x-8 mb-6">
                        <div class="w-full">
                            <label for="name" class="block font-bold text-black">Nom</label>
                            <input type="text" name="name" id="name" class="input-field w-full px-6 py-3 rounded-lg font-medium bg-gray-100 border border-gray-300 placeholder-gray-500 text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition duration-300 ease-in-out" value="{{ old('name') }}" required autofocus />
                            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="w-full">
                            <label for="email" class="block font-bold text-black">Email</label>
                            <input type="email" name="email" id="email" class="input-field w-full px-6 py-3 rounded-lg font-medium bg-gray-100 border border-gray-300 placeholder-gray-500 text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition duration-300 ease-in-out" value="{{ old('email') }}" required />
                            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Phone and Address fields -->
                    <div class="flex space-x-8 mb-6">
                        <div class="w-full">
                            <label for="phone" class="block font-bold text-black">Numéro de téléphone</label>
                            <input type="text" name="phone" id="phone" class="input-field w-full px-6 py-3 rounded-lg font-medium bg-gray-100 border border-gray-300 placeholder-gray-500 text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition duration-300 ease-in-out" value="{{ old('phone') }}" required />
                            @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="w-full">
                            <label for="address" class="block font-bold text-black">Adresse</label>
                            <input type="text" name="address" id="address" class="input-field w-full px-6 py-3 rounded-lg font-medium bg-gray-100 border border-gray-300 placeholder-gray-500 text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition duration-300 ease-in-out" value="{{ old('address') }}" required />
                            @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Password and Confirmation fields -->
                    <div class="flex space-x-8 mb-6">
                        <div class="w-full">
                            <label for="password" class="block font-bold text-black">Mot de passe</label>
                            <input type="password" name="password" id="password" class="input-field w-full px-6 py-3 rounded-lg font-medium bg-gray-100 border border-gray-300 placeholder-gray-500 text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition duration-300 ease-in-out" required />
                            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="w-full">
                            <label for="password_confirmation" class="block font-bold text-black">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="input-field w-full px-6 py-3 rounded-lg font-medium bg-gray-100 border border-gray-300 placeholder-gray-500 text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition duration-300 ease-in-out" required />
                        </div>
                    </div>

                    <!-- Profile Picture -->
                    <div class="mx-auto mt-6">
                        <label for="profile_picture" class="block font-bold text-black">Photo de profil</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="w-full px-6 py-3 rounded-lg font-medium bg-gray-100 border border-gray-300 text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition duration-300 ease-in-out" />
                        @error('profile_picture') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submitButton" class="submit-btn mt-6 tracking-wide font-semibold bg-indigo-600 text-white w-full py-3 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:outline-none">
                        <span class="ml-3">Créer un compte</span>
                    </button>
                </form>

                <!-- Google Login Button -->
                <div class="text-center mt-8 flex justify-center">
                    <a href="{{ route('google.login') }}" class="google-btn w-full max-w-xs font-bold shadow-sm rounded-lg py-3 bg-indigo-100 text-gray-800 flex items-center justify-center transition-all duration-300 ease-in-out focus:outline-none hover:shadow-lg focus:shadow-outline">
                        <div class="bg-white p-2 rounded-full">
                            <svg class="w-4" viewBox="0 0 533.5 544.3">
                                <path d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h147c-6.1 33.8-25.7 63.7-54.4 82.7v68h87.7c51.5-47.4 81.1-117.4 81.1-200.2z" fill="#4285f4" />
                                <path d="M272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-87.7-68c-24.4 16.6-55.9 26-92.6 26-71 0-131.2-47.9-152.8-112.3H28.9v70.1c46.2 91.9 140.3 149.9 243.2 149.9z" fill="#34a853" />
                                <path d="M119.3 324.3c-11.4-33.8-11.4-70.4 0-104.2V150H28.9c-38.6 76.9-38.6 167.5 0 244.4l90.4-70.1z" fill="#fbbc04" />
                                <path d="M272.1 107.7c38.8-.6 76.3 14 104.4 40.8l77.7-77.7C405 24.6 339.7-.8 272.1 0 169.2 0 75.1 58 28.9 150l90.4 70.1c21.5-64.5 81.8-112.4 152.8-112.4z" fill="#ea4335" />
                            </svg>
                        </div>
                        <span class="ml-4">Se connecter avec Google</span>
                    </a>
                </div>

                <!-- Login Link -->
                <div class="text-center mt-5">
                    <p class="text-sm text-gray-600">
                        Vous avez déjà un compte ?
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800">Se connecter</a>
                    </p>
                </div>
            </div>

            <!-- Right side image (optional) -->
            <div class="flex-1 bg-indigo-100 text-center hidden lg:flex">
                <!-- Add image or design here -->
            </div>

        </div>
    </div>

    <style>
        /* Button annimation */
        .blink {
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0.5;
            }
        }


        .roll-up {
            animation: rollUp 0.5s ease-in-out forwards;
        }

        @keyframes rollUp {
            0% {
                transform: translateY(0);
                opacity: 1;
            }
            100% {
                transform: translateY(-100%);
                opacity: 0;
            }
        }
    </style>

    <script>
        const fields = document.querySelectorAll('.input-field');
        const submitButton = document.getElementById('submitButton');

        // animer le bouton si j ecrit
        fields.forEach(field => {
            field.addEventListener('input', () => {
                submitButton.classList.add('blink');
            });
        });

        // enrouller le le buton
        submitButton.addEventListener('click', (e) => {
            e.preventDefault();
            submitButton.classList.remove('blink');
            submitButton.classList.add('roll-up');
            setTimeout(() => {
                document.getElementById('registerForm').submit();
            }, 500);
        });
    </script>
</x-guest-layout>
