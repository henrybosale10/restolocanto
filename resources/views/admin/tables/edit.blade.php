<x-admin-layout>
    <!-- En-tête de la page -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier une Table') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bouton pour revenir à l'index des tables -->
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.tables.index') }}" class="px-4 py-2 bg-indigo-700 text-white rounded-lg">Retour</a>
            </div>

            <!-- Formulaire pour modifier une table -->
            <div class="m-2 p-2 bg-slate-100 rounded">
                <form method="POST" action="{{ route('admin.tables.update', $table->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nom de la table -->
                    <div class="sm:col-span-6 mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" id="name" name="name" value="{{ $table->name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nombre d'invités -->
                    <div class="sm:col-span-6 mb-4">
                        <label for="guest_number" class="block text-sm font-medium text-gray-700">Nombre d'invités</label>
                        <input type="number" id="guest_number" name="guest_number" value="{{ $table->guest_number }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('guest_number')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Statut de la table -->
                    <div class="sm:col-span-6 mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                        <select id="status" name="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            @foreach (App\Enums\StatutTable::cases() as $status)
                                <option value="{{ $status->value }}" @if($table->status === $status->value) selected @endif>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Emplacement de la table -->
                    <div class="sm:col-span-6 mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700">Emplacement</label>
                        <select id="location" name="location" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            @foreach (App\Enums\TableLocation::cases() as $location)
                                <option value="{{ $location->value }}" @if($table->location === $location->value) selected @endif>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('location')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="sm:col-span-6 mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" id="image" name="image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @if ($table->image)
                            <img src="{{ Storage::url($table->image) }}" class="w-16 h-16 rounded mt-2">
                        @endif
                        @error('image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Bouton de validation -->
                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-lg">
                        Modifier
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
