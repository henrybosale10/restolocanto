<x-admin-layout>
    <div class="container mx-auto mt-5">
        <h2 class="text-center text-2xl font-bold mb-4">Détails de la Notification</h2>

        <!-- Affichage des détails de la notification -->
        <div class="bg-white shadow-md rounded p-5">

            <!-- ID de la Notification -->
            <div class="flex items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-6 h-6 text-blue-500 mr-3">
                    <path d="M12 1L8 4h4v15h4V4h4z" />
                </svg>
                <p class="font-bold mb-2">ID de la Notification:</p>
            </div>
            <p>{{ $notification->id }}</p>

            <!-- Notifiable ID -->
            <div class="flex items-center mb-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-6 h-6 text-blue-500 mr-3">
                    <path d="M12 2C8.13 2 5 5.13 5 8c0 1.78 1.18 3.32 2.82 3.88 0-.01.01-.02.01-.02L12 21l4.17-8.14c.01.01.01.02.01.02C17.82 11.32 19 9.78 19 8c0-2.87-3.13-6-7-6z"/>
                </svg>
                <p class="font-bold mb-2">Notifiable ID:</p>
            </div>
            <p>{{ $notification->notifiable_id }}</p>

            <!-- Notifiable Type -->
            <div class="flex items-center mb-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-6 h-6 text-blue-500 mr-3">
                    <path d="M19 11l-7 7-7-7" />
                </svg>
                <p class="font-bold mb-2">Notifiable Type:</p>
            </div>
            <p>{{ $notification->notifiable_type }}</p>

            <!-- Type de la Notification -->
            <div class="flex items-center mb-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-6 h-6 text-blue-500 mr-3">
                    <path d="M12 4v16m8-8H4" />
                </svg>
                <p class="font-bold mb-2">Type de la Notification:</p>
            </div>
            <p>{{ $notification->type }}</p>

            <!-- Données -->
            <div class="flex items-center mb-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-6 h-6 text-blue-500 mr-3">
                    <path d="M3 3h18v18H3z"/>
                </svg>
                <p class="font-bold mb-2">Données:</p>
            </div>
            <pre class="bg-gray-100 p-3 rounded">{{ $notification->data }}</pre>

            <!-- Date de Lecture -->
            <div class="flex items-center mb-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-6 h-6 text-blue-500 mr-3">
                    <path d="M21 12l-7 7-7-7" />
                </svg>
                <p class="font-bold mb-2">Date de Lecture:</p>
            </div>
            <p>{{ $notification->read_at ? $notification->read_at->format('d/m/Y H:i') : 'Non lue' }}</p>

            <!-- Date de Création -->
            <div class="flex items-center mb-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-6 h-6 text-blue-500 mr-3">
                    <path d="M12 4v16m8-8H4" />
                </svg>
                <p class="font-bold mb-2">Date de Création:</p>
            </div>
            <p>{{ $notification->created_at->format('d/m/Y H:i') }}</p>

            <div class="mt-4">
                <a href="{{ route('notifications.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Retour</a>
            </div>
        </div>
    </div>
</x-admin-layout>
