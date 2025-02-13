<x-guest-layout>
    <div class="bg-gradient-to-r from-blue-300 to-purple-500 min-h-screen flex justify-center items-center">
        <div class="py-8 px-6 max-w-4xl bg-white bg-opacity-30 rounded-lg shadow-lg backdrop-blur-xl backdrop-filter">
            <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-5">Réservation</h1>
            <p class="text-lg text-center text-gray-700 mb-8">Complétez vos informations</p>
            <form method="POST" action="{{ route('reservations.store') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @csrf

                <!-- Champ Prénom -->
                <div class="mb-5 flex items-center">
                    <i class="fas fa-user text-gray-500 mr-3"></i>
                    <label for="prenom" class="text-gray-700 font-semibold mb-2">Prénom</label>
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom" value="{{ old('prenom') }}"
                        class="bg-transparent border rounded-lg shadow border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 py-2 px-4 block w-full appearance-none leading-normal @error('prenom') border-red-500 @enderror" />
                    @error('prenom')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ Nom -->
                <div class="mb-5 flex items-center">
                    <i class="fas fa-user-tag text-gray-500 mr-3"></i>
                    <label for="nom" class="text-gray-700 font-semibold mb-2">Nom</label>
                    <input type="text" name="nom" id="nom" placeholder="Nom" value="{{ old('nom') }}"
                        class="bg-transparent border rounded-lg shadow border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 py-2 px-4 block w-full appearance-none leading-normal @error('nom') border-red-500 @enderror" />
                    @error('nom')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ Email -->
                <div class="mb-5 flex items-center">
                    <i class="fas fa-envelope text-gray-500 mr-3"></i>
                    <label for="email" class="text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}"
                        class="bg-transparent border rounded-lg shadow border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 py-2 px-4 block w-full appearance-none leading-normal @error('email') border-red-500 @enderror" />
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ Téléphone -->
                <div class="mb-5 flex items-center">
                    <i class="fas fa-phone-alt text-gray-500 mr-3"></i>
                    <label for="telephone" class="text-gray-700 font-semibold mb-2">Téléphone</label>
                    <input type="text" name="telephone" id="telephone" placeholder="Téléphone" value="{{ old('telephone') }}"
                        class="bg-transparent border rounded-lg shadow border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 py-2 px-4 block w-full appearance-none leading-normal @error('telephone') border-red-500 @enderror" />
                    @error('telephone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ Date de Réservation -->
                <div class="mb-5 flex items-center">
                    <i class="fas fa-calendar-alt text-gray-500 mr-3"></i>
                    <label for="date_reservation" class="text-gray-700 font-semibold mb-2">Date</label>
                    <input type="date" name="date_reservation" id="date_reservation" value="{{ old('date_reservation') }}"
                        min="{{ $min_date }}" max="{{ $max_date }}"
                        class="bg-transparent border rounded-lg shadow border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 py-2 px-4 block w-full appearance-none leading-normal @error('date_reservation') border-red-500 @enderror" />
                    @error('date_reservation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ Nombre d'invités -->
                <div class="mb-5 flex items-center">
                    <i class="fas fa-users text-gray-500 mr-3"></i>
                    <label for="guest_number" class="text-gray-700 font-semibold mb-2">Nombre d'invités</label>
                    <input type="number" name="guest_number" id="guest_number" placeholder="Nombre d'invités" value="{{ old('guest_number') }}"
                        min="1" step="1"
                        class="bg-transparent border rounded-lg shadow border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 py-2 px-4 block w-full appearance-none leading-normal @error('guest_number') border-red-500 @enderror" />
                    @error('guest_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sélection de la Table -->
                <div class="mb-5 flex items-center">
                    <i class="fas fa-table text-gray-500 mr-3"></i>
                    <label for="table_id" class="text-gray-700 font-semibold mb-2">Choisir une table</label>
                    <select name="table_id" id="table_id"
                        class="bg-transparent border rounded-lg shadow border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 py-2 px-4 block w-full appearance-none leading-normal @error('table_id') border-red-500 @enderror">
                        @forelse ($tables as $table)
                            <option value="{{ $table->id }}" @selected(old('table_id') == $table->id)>
                                {{ $table->name }} ({{ $table->guest_number }} invités)
                            </option>
                        @empty
                            <option disabled>Aucune table disponible</option>
                        @endforelse
                    </select>
                    @error('table_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bouton de soumission -->
                <div class="col-span-2 text-right">
                    <button type="submit"
                        class="bg-gradient-to-r from-purple-400 to-indigo-500 text-white font-semibold py-2 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out mb-5">
                        Confirmer la réservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
