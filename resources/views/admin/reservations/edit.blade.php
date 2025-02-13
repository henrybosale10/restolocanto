<x-admin-layout>
    <!-- En-tête de la page -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bouton pour revenir à l'index des réservations -->
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.reservations.index') }}" class="px-4 py-2 bg-indigo-700 rounded-lg">Index Réservations</a>
            </div>
            <!-- Formulaire pour modifier une réservation -->
            <div class="m-2 p-2 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.reservations.update', $reservation->id) }}">
                        @csrf
                        @method('PUT')
                        <!-- Champ pour le prénom -->
                        <div class="sm:col-span-6">
                            <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                            <input type="text" id="prenom" name="prenom" value="{{ $reservation->prenom }}" class="block w-full border border-gray-400 rounded-md py-2 px-3">
                        </div>
                        <!-- Champ pour le nom -->
                        <div class="sm:col-span-6">
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="nom" name="nom" value="{{ $reservation->nom }}" class="block w-full border border-gray-400 rounded-md py-2 px-3">
                        </div>
                        <!-- Champ pour l'email -->
                        <div class="sm:col-span-6 pt-5">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ $reservation->email }}" class="block w-full border border-gray-400 rounded-md py-2 px-3">
                        </div>
                        <!-- Champ pour le téléphone -->
                        <div class="sm:col-span-6 pt-5">
                            <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <input type="text" id="telephone" name="telephone" value="{{ $reservation->telephone }}" class="block w-full border border-gray-400 rounded-md py-2 px-3">
                        </div>
                        <!-- Champ pour la date et heure de la réservation -->
                        <div class="sm:col-span-6 pt-5">
                            <label for="date_reservation" class="block text-sm font-medium text-gray-700">Date et Heure de Réservation</label>
                            <input type="datetime-local" id="date_reservation" name="date_reservation" value="{{ $reservation->date_reservation->format('Y-m-d\TH:i') }}" class="block w-full border border-gray-400 rounded-md py-2 px-3">
                        </div>
                        <!-- Sélection de la table -->
                        <div class="sm:col-span-6 pt-5">
                            <label for="table_id" class="block text-sm font-medium text-gray-700">Table</label>
                            <select id="table_id" name="table_id" class="block w-full border border-gray-400 rounded-md py-2 px-3">
                                @foreach ($tables as $table)
                                    <option value="{{ $table->id }}" @selected($reservation->table_id == $table->id)>{{ $table->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Champ pour le nombre de convives -->
                        <div class="sm:col-span-6 pt-5">
                            <label for="guest_number" class="block text-sm font-medium text-gray-700">Nombre de Convives</label>
                            <input type="number" id="guest_number" name="guest_number" min="1" value="{{ $reservation->guest_number }}" class="block w-full border border-gray-400 rounded-md py-2 px-3">
                        </div>
                        <!-- Bouton de validation -->
                        <button type="submit" class="px-4 py-2 bg-slate-500 hover:bg-indigo-900 rounded-lg">Modifier la Réservation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
