<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(session('error'))
        <div
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6"
            x-data="{ show: true }"
            x-show="show"
            x-transition
        >
            <div class="flex items-center justify-between bg-red-100 dark:bg-red-900 border border-red-300 dark:border-red-700 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg shadow-md">
                <div class="flex items-center space-x-2">
                    <!-- Fouticoon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 19a7 7 0 110-14 7 7 0 010 14z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>

                <!-- Sluitknop -->
                <button
                    @click="show = false"
                    class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200 focus:outline-none"
                    title="Sluiten"
                >
                    ✕
                </button>
            </div>
        </div>
    @endif


    <div class="py-12 space-y-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center">
                    <h1>Hier vind je alle benodigde links om je team te bouwen!</h1>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="/players/country/1">Go to players</a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="/my-team">Check your team</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
