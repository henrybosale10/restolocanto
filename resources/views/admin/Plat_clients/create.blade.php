<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer un Plat Client') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold text-[black] mb-6">Créer un Plat Client</h1>

        <form method="POST" action="{{ route('admin.platclients.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 gap-6">
          @csrf

          <!-- Nom du PlatClient -->
          <div class="p-2">
            <input type="text" id="nom" name="nom" placeholder="Nom du Plat Client" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;" value="{{ old('nom') }}" required>
            @error('nom')
              <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Description -->
          <div class="p-2">
            <textarea id="description" name="description" rows="3" placeholder="Description du Plat Client" class="block w-full h-48 rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;" required>{{ old('description') }}</textarea>
            @error('description')
              <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Prix -->
          <div class="p-2">
            <input type="number" id="prix" name="prix" placeholder="Prix" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;" step="0.01" value="{{ old('prix') }}" required>
            @error('prix')
              <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Image Upload -->
          <div class="p-2">
            <label for="image-upload" class="block w-full h-48 border-2 border-dashed border-gray-300 rounded-md cursor-pointer flex flex-col items-center justify-center bg-[#f6f6f6] hover:bg-gray-50">
              <div class="text-center">
                <div class="mb-2">
                  <button type="button" class="bg-[#8c0327] hover:bg-[#6b0220] text-white rounded-full py-2 px-4">Sélectionner une image</button>
                </div>
                <p class="text-gray-500">ou faites glisser l'image ici</p>
                <p class="text-gray-500 text-sm mt-1">PNG, JPG, SVG</p>
              </div>
            </label>
            <input id="image-upload" name="image" type="file" accept="image/*" class="sr-only">
            @error('image')
              <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Sélection du Plat -->
          <div class="p-2">
            <select name="plat_id" id="plat_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;" required>
              <option value="">Sélectionner un Plat</option>
              @foreach($plats as $plat)
                <option value="{{ $plat->id }}">{{ $plat->nom }}</option>
              @endforeach
            </select>
            @error('plat_id')
              <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Enregistrer -->
          <div class="col-span-full mt-6 p-2">
            <button type="submit" class="block w-full bg-[#8c0327] hover:bg-[#6b0220] text-white font-bold py-3 px-4 rounded-full">
              Enregistrer
            </button>
          </div>
        </form>
      </div>

</x-admin-layout>
