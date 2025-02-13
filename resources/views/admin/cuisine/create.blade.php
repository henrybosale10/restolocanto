<x-admin-layout>
    <!-- En-tête de la page -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bouton pour revenir à l'index des menus -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.cuisine.index') }}" class="px-6 py-3 bg-indigo-700 text-white font-semibold rounded-lg hover:bg-indigo-800 transition duration-300">
                    Retour à l'index de Cuisine
                </a>
            </div>

            <!-- Formulaire pour créer un menu -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="space-y-8 divide-y divide-gray-200">
                    <form method="POST"  action="{{ route('admin.cuisine.store') }}"  enctype="multipart/form-data">

                        @csrf

                        <!-- Nom -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Type de Cuisine</label>
                            <input type="text" id="name" name="name" " required class="block w-full border border-gray-300 rounded-md py-2 px-3 mt-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" required class="block w-full border border-gray-300 rounded-md py-2 px-3 mt-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"> </textarea>
                            @error('description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>

                            <input type="file" id="image" name="image" required class="block w-full border border-gray-300 rounded-md py-2 px-3 mt-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>





                        <!-- Bouton de soumission -->
                        <div>
                            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition duration-300">
                                Créer une Categorie
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
