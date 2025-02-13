<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter un Plat') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold text-[black] mb-6">Ajouter un Plat</h1>

        <form action="{{ route('admin.plats.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-6">
          @csrf

          <!-- Plat Name -->
          <div class="p-2">
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Nom du Plat" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;" required>
            @error('nom')
              <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
          </div>

          <!-- Description -->
          <div class="p-2">
            <textarea id="description" name="description" rows="3" placeholder="Description du Plat" class="block w-full h-48 rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;">{{ old('description') }}</textarea>
            @error('description')
              <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
          </div>

          <!-- Image Upload -->
          <div class="p-2">
            <label for="image-upload" class="block w-full h-48 border-2 border-dashed border-gray-300 rounded-md cursor-pointer flex flex-col items-center justify-center bg-[#f6f6f6] hover:bg-gray-50">
              <div class="text-center">
                <div class="mb-2">
                  <button type="button" class="bg-[#8c0327] hover:bg-[#6b0220] text-white rounded-full py-2 px-4">Sélectionner depuis l'ordinateur</button>
                </div>
                <p class="text-gray-500">ou glissez une photo ici</p>
                <p class="text-gray-500 text-sm mt-1">PNG, JPG, SVG</p>
              </div>
            </label>
            <input id="image-upload" name="image" type="file" accept="image/*" class="sr-only">
            @error('image')
              <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
          </div>

          <!-- Submit Button -->
          <div class="col-span-full mt-6 p-2">
            <button type="submit" class="block w-full bg-[#8c0327] hover:bg-[#6b0220] text-white font-bold py-3 px-4 rounded-full">
              Ajouter le Plat
            </button>
          </div>
        </form>
      </div>

</x-admin-layout>
