<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer une réservation') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold text-[black] mb-6">Créer une réservation</h1>

        <form action="{{ route('admin.reservations.store') }}" method="POST" class="grid grid-cols-1 gap-6">
          @csrf

          <!-- Prénom -->
          <div class="p-2">
            <input type="text" id="prenom" name="prenom" placeholder="Prénom" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;" required>
          </div>

          <!-- Nom -->
          <div class="p-2">
            <input type="text" id="nom" name="nom" placeholder="Nom" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;" required>
          </div>

          <!-- Email -->
          <div class="p-2">
            <input type="email" id="email" name="email" placeholder="Email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;" required>
          </div>

          <!-- Téléphone -->
          <div class="p-2">
            <input type="text" id="telephone" name="telephone" placeholder="Téléphone" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;" required>
          </div>

          <!-- Date de réservation -->
          <div class="p-2">
            <input type="datetime-local" id="date_reservation" name="date_reservation" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;" required>
          </div>

          <!-- Table -->
          <div class="p-2">
            <select id="table_id" name="table_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;" required>
              <option value="" disabled selected>Choisissez une table</option>
              @foreach($tables as $table)
                <option value="{{ $table->id }}">{{ $table->name }} ({{$table->guest_number}})</option>
              @endforeach
            </select>
          </div>

          <!-- Nombre d'invités -->
          <div class="p-2">
            <input type="number" id="guest_number" name="guest_number" placeholder="Nombre d'invités" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2" style="background-color: #f6f6f6;" required>
          </div>

          <!-- Bouton de soumission -->
          <div class="col-span-full mt-6 p-2">
            <button type="submit" class="block w-full bg-[#8c0327] hover:bg-[#6b0220] text-white font-bold py-3 px-4 rounded-full">
              Créer la réservation
            </button>
          </div>
        </form>
      </div>

</x-admin-layout>
