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
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.cuisine.index') }}" class="px-4 py-2 bg-indigo-700 rounded-lg">index MENU</a>
            </div>
            <!-- Formulaire pour créer un menu -->
            <div class="m-2 p-2 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.cuisine.update',$cuisine->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Champ pour le nom -->
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">TYpe de Cuisine</label>

                            <input type="text" id="name" name="name"  class="block w-full border border-gray-400 rounded-md py-2 px-3">
                        </div>
                        <!-- Champ pour l'image -->
                        <div class="sm:col-span-6">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>

                            <input type="file" id="image" name="image" class="block w-full border border-gray-400 rounded-md py-2 px-3">
                            <img src="{{ Storage::url($cuisine->image) }}" class="w-16 h-16 rounded">
                        </div>

                        <!-- Champ pour la description -->
                        <div class="sm:col-span-6 pt-5">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="3"  class="block w-full border border-gray-400 rounded-md py-2 px-3">
                                {{$cuisine->description}}
                            </textarea>
                        </div>


                        <!-- Bouton de validation -->
                        <button type="submit" class="px-4 py-2 bg-slate-500 hover:bg-indigo-900 rounded-lg">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
