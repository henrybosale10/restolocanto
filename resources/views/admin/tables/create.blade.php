<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer une nouvelle Table') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold text-black mb-6">Créer une Nouvelle Table</h1>

        <div class="flex mb-6">
          <a href="{{ route('admin.tables.index') }}" class="px-4 py-2 bg-indigo-700 text-white rounded-lg">
            Retour
          </a>
        </div>

        <form method="POST" action="{{ route('admin.tables.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 gap-6">
          @csrf

          <!-- Nom -->
          <div class="p-2">
            <input type="text" id="name" name="name" placeholder="Nom" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2 bg-[#f6f6f6]">
            @error('name')
              <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>

          <!-- Nombre d'invités -->
          <div class="p-2">
            <input type="number" id="guest_number" name="guest_number" placeholder="Nombre d'invités" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2 bg-[#f6f6f6]">
            @error('guest_number')
              <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>

          <!-- Statut -->
          <div class="p-2">
            <select id="status" name="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2 bg-[#f6f6f6]">
              <option value="">Sélectionnez un statut</option>
              @foreach (App\Enums\StatutTable::cases() as $status)
                <option value="{{ $status->value }}">{{ $status->name }}</option>
              @endforeach
            </select>
            @error('status')
              <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>

          <!-- Emplacement -->
          <div class="p-2">
            <select id="location" name="location" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2 bg-[#f6f6f6]">
              <option value="">Sélectionnez un emplacement</option>
              @foreach (App\Enums\TableLocation::cases() as $location)
                <option value="{{ $location->value }}">{{ $location->name }}</option>
              @endforeach
            </select>
            @error('location')
              <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>

          <!-- Image Upload -->
          <div class="p-2">
            <label for="image" class="block w-full h-48 border-2 border-dashed border-gray-300 rounded-md cursor-pointer flex flex-col items-center justify-center bg-[#f6f6f6] hover:bg-gray-50">
              <div class="text-center">
                <div class="mb-2">
                  <button type="button" class="bg-[#8c0327] hover:bg-[#6b0220] text-white rounded-full py-2 px-4">Sélectionnez une image</button>
                </div>
                <p class="text-gray-500">ou glissez une photo ici</p>
                <p class="text-gray-500 text-sm mt-1">PNG, JPG, SVG</p>
              </div>
            </label>
            <input id="image" name="image" type="file" accept="image/*" class="sr-only">
          </div>

          <!-- Bouton de soumission -->
          <div class="p-2">
            <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-lg w-full">
              Enregistrer
            </button>
          </div>
        </form>
      </div>

</x-admin-layout>
