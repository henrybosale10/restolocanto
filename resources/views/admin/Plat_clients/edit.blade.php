<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier Plat Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('admin.platclients.update', $platClient->id) }}" enctype="multipart/form-data" class="space-y-6 p-6">
                    @csrf
                    @method('PUT')

                    <!-- Grille -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                            <input type="text" name="nom" id="nom"
                                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"
                                   required
                                   value="{{ old('nom', $platClient->nom) }}">
                            @error('nom')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Prix -->
                        <div>
                            <label for="prix" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prix (CDF)</label>
                            <input type="number" name="prix" id="prix"
                                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"
                                   step="0.01" required
                                   value="{{ old('prix', $platClient->prix) }}">
                            @error('prix')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description"
                                      class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">{{ old('description', $platClient->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Plat associé -->
                        <div>
                            <label for="plat_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Plat associé</label>
                            <select name="plat_id" id="plat_id"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                @foreach($plats as $plat)
                                    <option value="{{ $plat->id }}" {{ $platClient->plat_id == $plat->id ? 'selected' : '' }}>
                                        {{ $plat->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('plat_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                            <input type="file" name="image" id="image"
                                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
                            @if($platClient->image)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($platClient->image) }}" alt="Image actuelle" class="w-20 h-20 object-cover rounded-md">
                                </div>
                            @endif
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('admin.platclients.index') }}"
                           class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg shadow-sm">
                            Vers Index
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-sm">
                            Mettre à jour Plat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
