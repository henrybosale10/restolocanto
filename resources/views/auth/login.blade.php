<x-guest-layout>
    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center items-center">
        <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow-xl sm:rounded-lg flex justify-center flex-1">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/henofood.png') }}" alt="HenoFood" class="w-16 h-16 rounded-full border-2 border-gray-200">
                </div>

                <div class="mt-8 flex flex-col items-center">
                    <h1 class="text-2xl xl:text-3xl font-extrabold text-gray-800 mb-8">
                        Se connecter
                    </h1>

                    <!-- Affichage des erreurs -->
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-600 p-4 rounded-lg my-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="w-full">
                        @csrf
                        <div class="mx-auto max-w-xs">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-indigo-500 focus:bg-white mb-5" required aria-required="true" aria-describedby="emailError" />
                            @error('email')
                                <span id="emailError" class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mx-auto max-w-xs mt-5">
                            <label for="password" class="sr-only">Mot de passe</label>
                            <input type="password" name="password" id="password" class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-indigo-500 focus:bg-white mb-5" required aria-required="true" aria-describedby="passwordError" />
                            @error('password')
                                <span id="passwordError" class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="mt-5 tracking-wide font-semibold bg-indigo-600 text-white w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out focus:shadow-outline focus:outline-none">
                            <span class="ml-3">Se connecter</span>
                        </button>
                    </form>

                    <!-- Forgot Password Link -->
                    <div class="mt-3 text-sm text-indigo-600 hover:text-indigo-800 text-center">
                        <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                    </div>

                    <div class="my-12 border-b text-center">
                        <div class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2">
                            Ou se connecter avec
                        </div>
                    </div>

                    <!-- Google Login Button -->
                    <div class="w-full flex justify-center">
                        <a href="{{ route('google.login') }}" class="w-full max-w-xs font-bold shadow-sm rounded-lg py-3 bg-indigo-100 text-gray-800 flex items-center justify-center transition-all duration-300 ease-in-out focus:outline-none hover:shadow focus:shadow-sm focus:shadow-outline mt-5">
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

                    <!-- Register Button -->
                    <div class="text-center mt-5">
                        <p class="text-sm text-gray-600">
                            Pas encore de compte ?
                            <a href="{{ route('inscription') }}" class="text-indigo-600 hover:text-indigo-800">Créer un compte</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles pour l'animation -->
    <style>
        @keyframes blink {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
            100% {
                opacity: 1;
            }
        }

        .blink {
            animation: blink 1s infinite;
        }

        @keyframes rollClose {
            0% {
                height: 100%;
                padding: 16px;
            }
            100% {
                height: 0;
                padding: 0;
                opacity: 0;
            }
        }

        .roll-close {
            animation: rollClose 0.5s forwards;
            pointer-events: none;  /* Empêche l'interaction pendant l'animation */
        }
    </style>

    <!-- Script pour l'activation de l'animation -->
    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const submitButton = document.querySelector('button[type="submit"]');

        function toggleBlinkEffect() {
            if (emailInput.value || passwordInput.value) {
                submitButton.classList.add('blink');
            } else {
                submitButton.classList.remove('blink');
            }
        }

        emailInput.addEventListener('input', toggleBlinkEffect);
        passwordInput.addEventListener('input', toggleBlinkEffect);

        submitButton.addEventListener('click', function (event) {
            event.preventDefault();
            if (emailInput.value && passwordInput.value) {
                submitButton.classList.add('roll-close');
                setTimeout(() => {
                    document.querySelector('form').submit(); // Soumettre le formulaire après l'animation
                }, 500);
            }
        });
    </script>
</x-guest-layout>
