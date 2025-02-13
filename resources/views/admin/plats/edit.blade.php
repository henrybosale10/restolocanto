<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier un Plat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg bg-white dark:bg-gray-800">
                <form action="{{ route('admin.plats.update', $plat->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="px-6 py-4">
                        <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nom du Plat</label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom', $plat->nom) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>

                        @error('nom')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="px-6 py-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Description</label>
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">{{ old('description', $plat->description) }}</textarea>

                        @error('description')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="px-6 py-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Image</label>
                        <input type="file" id="image" name="image" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">

                        @error('image')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="px-6 py-4">
                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">Mettre à jour le Plat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
