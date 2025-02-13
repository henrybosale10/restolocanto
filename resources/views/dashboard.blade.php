<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center p-4 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <!-- Logo Laravel suivi de Dashboard -->
            <div class="flex items-center gap-2">
                <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" class="w-8 h-8">
                <h2 class="font-semibold text-2xl text-gray-700 dark:text-gray-300 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <!-- Bouton Admin -->
                <button class="ml-4 px-6 py-3 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition-all duration-200">
                    {{ __('Admin') }}
                </button>
            </div>

            <!-- Avatar Admin dans le coin -->
            <div>
                <img src="https://via.placeholder.com/40"
                     alt="Admin Avatar"
                     class="w-10 h-10 rounded-full border-2 border-gray-300 dark:border-gray-600 shadow-lg">
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-6xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-8 text-gray-700 dark:text-gray-200">
                    <h3 class="text-3xl font-bold text-indigo-600 dark:text-indigo-400 mb-4">{{ __("You're logged in dash!") }}</h3>
                    <p class="text-lg text-gray-600 dark:text-gray-300">
                        Welcome to your admin dashboard. You can manage all aspects of your site here, from user accounts to settings.
                    </p>
                    <div class="mt-6">
                        <button class="px-6 py-3 bg-green-500 text-white rounded-md shadow-md hover:bg-green-600 transition-all duration-200">
                            {{ __('View Stats') }}
                        </button>
                        <button class="ml-4 px-6 py-3 bg-yellow-500 text-white rounded-md shadow-md hover:bg-yellow-600 transition-all duration-200">
                            {{ __('Manage Content') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
